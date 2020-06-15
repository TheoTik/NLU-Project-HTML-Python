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

def in_black_list(words):
    new = []
    for word in words:
        if word in bad_words:
            new.append(word)
    return new

sys.argv.pop(0)
badword=[]
for arg in sys.argv:
    words =word_tokenize(arg.lower())
    badword.append(in_black_list(words))
print(badword)
