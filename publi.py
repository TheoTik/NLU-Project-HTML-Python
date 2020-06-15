#!/usr/bin/python3
# coding: utf8
try:
   import nltk;
   import sys;
   from nltk.tokenize import word_tokenize;
   from nltk.corpus import stopwords;
except Exception as e:
    print('Failed to open file: %s' % (e,));

nltk.data.path= ['/net/www/tcombalbert/NLU-Project/nltk_data'];

stop_words = set(stopwords.words('frenchtest'))
bad_words = set(stopwords.words('badwords'))

def not_in_white_list(words):
    new = []
    for word in words:
        if word not in stop_words:
            new.append(word)
    return new

def in_black_list(words):
    new = []
    for word in words:
        if word in bad_words:
            new.append(word)
    return new


def publication(words):
    t= not_in_white_list(words)

    if (len(t)==0):
        return t
    else :
        t= in_black_list(t)
        if(len(t)!= 0):
            return t
        else:
            return t

sys.argv.pop(0)
for arg in sys.argv:
    words =word_tokenize(arg.lower())
    print(publication(words))
