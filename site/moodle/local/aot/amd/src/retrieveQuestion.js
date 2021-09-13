/**
 * @module local_aot
 */

var i = 0;
var loaded = false;

define (['jquery', 'core/ajax'], function ($,Ajax) {
    let course_name = $('.next_question_button')[0].classList[2];
    let course_id = course_name.substr(course_name.lastIndexOf('next_button_') + 'next_button_'.length);
    let params = {'courseid':course_id};
    let request = {
        methodname:'local_aot_get_question',
        args:params,
    };
    var question_content;
    let questions;
    $('.record_button').prop("disabled", true);
    $('.next_question_button').prop("disabled", true);
    // $('.previous_question_button').prop("disabled", true);
    $('.end_button').prop("disabled", true);

    window.addEventListener('load', function () {
        Ajax.call([request])[0].done(function (data){
            if(data[i]==undefined){
                alert("no data");
            }else {
                questions=data;
                question_content = Object.values(questions[i])[1];
                $('.question_to_display').text("Question : " + question_content );
                loaded=true;
                $('.record_button').removeAttr('disabled');
            }
        }).fail(function (error) {
            Y.log(error);
            Y.log('failed');
        });
    });

    $('.next_question_button').click(function () {
        if(loaded){
            i++;
            if(questions[i]==undefined) {
                alert("You have answered all question, please click save button");
                $('.next_question_button').prop("disabled", true);
                $('.end_button').removeAttr('disabled');
            }else {
                question_content = Object.values(questions[i])[1];
                $('.question_to_display').text("Question : " + question_content);
            }
        }
    });

    // $('.previous_question_button').click(function () {
    //     if(loaded){
    //         i--;
    //         question_content = Object.values(questions[i])[1];
    //         $('.question_to_display').text("Question : " + question_content );
    //     }
    // });
});