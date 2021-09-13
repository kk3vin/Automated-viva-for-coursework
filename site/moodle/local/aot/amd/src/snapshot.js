define (['jquery', 'core/ajax'], function ($,Ajax) {
        let user_i = $('.end_button')[0].classList[1];
        let user_id = user_i.substr(user_i.lastIndexOf('save_record_userid_') + 'save_record_userid_'.length);
        let draft_context = $('.end_button')[0].classList[3];
        let draft_contextid = draft_context.substr(draft_context.lastIndexOf('save_record_draftcontextid_'
        ) + 'save_record_draftcontextid_'.length);
        let real_context = $('.end_button')[0].classList[4];
        let real_contextid = real_context.substr(real_context.lastIndexOf('save_record_realcontextid_'
        ) + 'save_record_realcontextid_'.length);
        let course_name = $('.next_question_button')[0].classList[2];
        let course_id = course_name.substr(course_name.lastIndexOf('next_button_') + 'next_button_'.length);
        let user_n = $('.end_button')[0].classList[5];
        let user_name = user_n.substr(user_n.lastIndexOf('save_record_username_') + 'save_record_username_'.length);


        $('.next_question_button').click(function () {
            takePhoto();
        });

    function takePhoto() {
            let canvas = $('.snapshot_canvas')[0];
            let ctx = canvas.getContext('2d');
            var video = $('.video_to_display')[0];
            ctx.drawImage(video, 0,0,250,200);
            var img_base64 = canvas.toDataURL().split(',')[1];
            var filename = user_name+'_'+course_id+ '.jpg';
            let params = {'imgfile':img_base64, 'userid':user_id, 'fileareaname':'profile_img',
                'draftcontextid':draft_contextid, 'realcontextid':real_contextid, 'courseid':course_id,
                'filename':filename};

            let request = {
                methodname:'local_aot_upload_snapshot',
                args:params,
            };

            Ajax.call([request])[0].done(function (data){
                if(data==true){
                    Y.log('img success upload');
                }else {
                    Y.log('img did not upload');
                }
            }).fail(function (error) {
                Y.log(error);
                Y.log('failed');
            });

        }

}
);