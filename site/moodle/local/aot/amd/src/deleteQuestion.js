define(['jquery', 'core/modal_factory', 'core/str', 'core/modal_events',
    'core/ajax'], function($, ModalFactory, String, ModalEvents, Ajax) {
    var trigger = $('.question_delete_button');
    ModalFactory.create({
        type: ModalFactory.types.SAVE_CANCEL,
        title: String.get_string('delete_question', 'local_aot'),
        body: String.get_string('delete_question_confirm', 'local_aot'),
        preShowCallback: function(triggerElement, modal) {
            triggerElement = $(triggerElement);
            let classString = triggerElement[0].classList[0];
            let questionid = classString.substr(classString.lastIndexOf('question') + 'question'.length);
            modal.params = {'questionid': questionid};
            modal.setSaveButtonText(String.get_string('delete_question', 'local_aot'));
        },
        large: true,
    }, trigger)
        .done(function(modal) {
            modal.getRoot().on(ModalEvents.save, function(e) {
                e.preventDefault();
                let footer = Y.one('.modal-footer');
                footer.setContent('Deleting...');
                let spinner = M.util.add_spinner(Y, footer);
                spinner.show();
                let request = {
                    methodname: 'local_aot_delete_question',
                    args: modal.params,
                };
                Ajax.call([request])[0].done(function(data) {
                    if (data === true) {
                        window.location.reload();
                    } else {
                        Y.log('delete question failed');
                    }
                }).fail(function (error) {
                    Y.log(error);
                    Y.log('failed');
                });
            });
        });

});