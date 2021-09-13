import face_recognition
import sys
import os
import urllib.request


def do_regonition(known_pics_url, unknow_pics_path_url):

    real_known_pics=urllib.request.urlopen(known_pics_url)
    real_unknow_pics_path=urllib.request.urlopen(unknow_pics_path_url)

    known_image = face_recognition.load_image_file(real_known_pics)
    unknown_image = face_recognition.load_image_file(real_unknow_pics_path)

    biden_encoding = face_recognition.face_encodings(known_image)[0]
    unknown_encoding = face_recognition.face_encodings(unknown_image)[0]

    results = face_recognition.compare_faces([biden_encoding], unknown_encoding)

    return results[0]

if __name__ == '__main__':
    print(do_regonition(sys.argv[1], sys.argv[2]))
