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


def edits1(word):
    "All edits that are one edit away from `word`."
    letters    = 'abcdefghijklmnopqrstuvwxyz'
    splits     = [(word[:i], word[i:])    for i in range(len(word) + 1)]
    deletes    = [L + R[1:]               for L, R in splits if R]
    transposes = [L + R[1] + R[0] + R[2:] for L, R in splits if len(R)>1]
    replaces   = [L + c + R[1:]           for L, R in splits if R for c in letters]
    inserts    = [L + c + R               for L, R in splits for c in letters]
    return set(deletes + transposes + replaces + inserts)

def edits2(word): return (e2 for e1 in edits1(word) for e2 in edits1(e1))

def known(text):
    words=word_tokenize(text.lower())
    new=[]
    for w in words:
       t=[]
       t=edits1(w)
       for w1 in t:
          if w1 in stop_words:
             new.append(w1)
    return new

def suppr(words):
    new=[]
    for l in words:
        if (l!="[" and l!="]"):
            new.append(l)
    return new

sys.argv.pop(0)
correct=[]
for arg in sys.argv:
    cor = known(arg)
    if (len(cor)!=0):
        correct.append(cor)
    else:
        correct.append("['None']")

print(correct)
