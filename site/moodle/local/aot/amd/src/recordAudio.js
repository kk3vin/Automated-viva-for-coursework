define(['jquery', 'core/ajax', 'core/modal_factory', 'core/str','core/modal_events'],
    function ($,Ajax, ModalFactory, String, ModalEvents) {
        var mediaStream;
        var mediaRecorder;
        var recorderFile;
        var stopRecordCallback;
        var videosContainer = document.getElementById('videos-container');

        let user_i = $('.end_button')[0].classList[1];
        let user_id = user_i.substr(user_i.lastIndexOf('save_record_userid_') + 'save_record_userid_'.length);
        let filearea = $('.end_button')[0].classList[2];
        let filearea_name = filearea.substr(filearea.lastIndexOf('save_record_filearea_') + 'save_record_filearea_'.length);
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
        let course_u = $('.end_button')[0].classList[6];
        let course_url = course_u.substr(course_u.lastIndexOf('save_record_courseurl_') + 'save_record_courseurl_'.length);
        let time_limitation_u = $('.end_button')[0].classList[7];
        let time_limitation = time_limitation_u.substr(time_limitation_u.lastIndexOf('save_record_timeLimitation_')
            + 'save_record_timeLimitation_'.length);



        var trigger = $('.record_button');
    ModalFactory.create({
        type:ModalFactory.types.SAVE_CANCEL,
        title:String.get_string('title','local_aot'),
        body:String.get_string('ready_viva', 'local_aot'),
        large:true,
    },trigger).done(function (modal) {
        modal.setSaveButtonText(String.get_string('confirm_viva', 'local_aot'));
        modal.getRoot().on(ModalEvents.save, function (e) {
            e.preventDefault();
            $('.next_question_button').removeAttr('disabled');
            // $('.previous_question_button').removeAttr('disabled');
            start_time_counting(time_limitation);
            startRecord(modal);
            $('.record_button').prop("disabled", true);
        });
    });


    // $('.record_button').click(function () {
    //     Y.log('Start recording');
    //     startRecord();
    // });

    $('.end_button').click(function () {
        Y.log('Save recording');
        Y.log(course_url);
        save();
    });







    // $('.take_photo_btn').click(function () {
    //     takePhoto();
    // });

    // Ready to record
    window.addEventListener('load', function () {
            var len = videosContainer.childNodes.length;
            for(var i=0;i<len;i++){
                videosContainer.removeChild(videosContainer.childNodes[i]);
            }
            var video = document.createElement('video');
            video.setAttribute('class', 'video_to_display');

            var videoWidth = 250;
            var videoHeight = 200;

            video.controls = false;
            video.muted = true;
            video.width = videoWidth;
            video.height = videoHeight;

            MediaUtils.getUserMedia(true, true, function (err, stream) {
                if (err) {
                    throw err;
                } else {
                    var audio_stream = new MediaStream(stream.getAudioTracks());
                     var video_stream = new MediaStream(stream.getVideoTracks());
                    mediaRecorder = new MediaRecorder(audio_stream);
                    mediaStream = audio_stream;
                    var chunks = [];
                    video.srcObject = video_stream;
                    video.play();
                    videosContainer.append(video);

                    mediaRecorder.ondataavailable = function(e) {
                        mediaRecorder.blobs.push(e.data);
                        chunks.push(e.data);
                    };
                    mediaRecorder.blobs = [];

                    mediaRecorder.onstop = function () {
                        recorderFile = new Blob(chunks, { 'type' : mediaRecorder.mimeType });
                        chunks = [];
                        if (stopRecordCallback !== null) {
                            stopRecordCallback();
                        }
                    };
                }
            });
    });

    var MediaUtils = {
        getUserMedia: function (videoEnable, audioEnable, callback) {
            navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia
                || navigator.msGetUserMedia || window.getUserMedia;
            var constraints = {video: videoEnable, audio: audioEnable};
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia(constraints).then(function (stream) {
                    callback(false, stream);
                })['catch'](function(err) {
                    callback(err);
                });
            } else if (navigator.getUserMedia) {
                navigator.getUserMedia(constraints, function (stream) {
                    callback(false, stream);
                }, function (err) {
                    callback(err);
                });
            } else {
                callback(new Error('Not support userMedia'));
            }
        },


        closeStream: function (stream) {
            if (typeof stream.stop === 'function') {
                stream.stop();
            }

            else {
                let trackList = [stream.getAudioTracks(), stream.getVideoTracks()];

                for (let i = 0; i < trackList.length; i++) {
                    let tracks = trackList[i];
                    if (tracks && tracks.length > 0) {
                        for (let j = 0; j < tracks.length; j++) {
                            let track = tracks[j];
                            if (typeof track.stop === 'function') {
                                track.stop();
                            }
                        }
                    }
                }
            }
        }
    };
    // function takePhoto() {
    //     let canvas = $('.snapshot_canvas')[0];
    //     let ctx = canvas.getContext('2d');
    //     var video = $('.video_to_display')[0];
    //     ctx.drawImage(video, 0,0,420,240);
    //     var img_base64 = canvas.toDataURL().split(',')[1];
    //     var filename = 'profile_img_'+user_name + '.jpg';
    //     let params = {'imgfile':img_base64, 'userid':user_id, 'fileareaname':'profile_img',
    //         'draftcontextid':draft_contextid, 'realcontextid':real_contextid, 'courseid':course_id,
    //         'filename':filename};
    //
    //     let request = {
    //         methodname:'local_aot_upload_snapshot',
    //         args:params,
    //     };
    //
    //     Ajax.call([request])[0].done(function (data){
    //         if(data==true){
    //             Y.log('img success upload');
    //         }else {
    //             Y.log('img did not upload');
    //         }
    //     }).fail(function (error) {
    //         Y.log(error);
    //         Y.log('failed');
    //     });
    //
    // }

    function startRecord(modal){
            mediaRecorder.start();
            modal.hide();
    }

    function stopRecord(callback) {
            stopRecordCallback = callback;
            mediaRecorder.stop();
            MediaUtils.closeStream(mediaStream);
            Y.log("stop recording");
    }
    function sendFile(){
                var file = new File([recorderFile], user_name + '.mp3', {
                    type: 'audio/mp3'
                });
                var filename = file.name;
                Y.log(file);
                var fileBase64;
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                fileBase64 = reader.result.split(',')[1];
                let params = {'videofile':fileBase64, 'userid':user_id, 'fileareaname':filearea_name,
                    'draftcontextid':draft_contextid, 'realcontextid':real_contextid, 'courseid':course_id,
                    'filename':filename};
                let request = {
                    methodname:'local_aot_upload_video',
                    args:params,
                };

                Ajax.call([request])[0].done(function (data){
                    if(data==true){
                        Y.log('success upload');
                        window.location.href=course_url;
                    }else {
                        Y.log('did not upload');
                    }
                }).fail(function (error) {
                    Y.log(error);
                    Y.log('failed');
                });
            };
    }
    function start_time_counting(mins) {
        var timeBar = document.getElementById('timeBar');
        var width = 0;
        var id = setInterval(start, 1000);
        function start() {
            if(width>=100){
                clearInterval(id);
                save();
            }else{
                width+=5/(3*mins);
                timeBar.style.width=width+'%';
            }
        }
    }
    function save() {
            stopRecord(function () {
                sendFile();
            });
        }
    }
);