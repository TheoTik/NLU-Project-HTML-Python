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

def Isinside(word, tab):
    for i in tab:
        if (i==word):
            return 'T'
    return 'F'

def Suppdouble(tab):
    k=0
    for i in [0,len(tab)-2-k]:
        for j in [i+1,len(tab)-1-k]:
            print(tab[i]+"\n")
            print(tab[j]+"\n")
            if (tab[i]==tab[j]):
                tab.remove(tab[j])
                k= k+1

def db(tab):
    tab2=[]
    for i in tab:
        if not (Isinside(i,tab2)):
            tab2.append(i)
    return tab2

def addlist(fichier1):
    fichier= open("textlist")
    fichier2= open(fichier1, mode="r+")
    contenu= fichier.read()
    contenu2= fichier2.read()
    tab= word_tokenize(contenu2)
    new = word_tokenize(contenu.lower())
    new2=db(new)
    fichier.close()
    for word in new2:
        if not (Isinside(word,tab)):
            fichier2.write(word +"\n")
    fichier2.close()

def addlistWhite():
    liste= open("/nltk_data/corpora/names/female.txt")
    fichier2= open("/nltk_data/corpora/stopwords/frenchtest", mode="r+")
    contenuList= liste.read()
    contenu2= fichier2.read()
    tab= word_tokenize(contenu2)
    new = word_tokenize(contenuList.lower())
    new2=db(new)
    liste.close()
    for word in new2:
        if not (Isinside(word,tab)):
            fichier2.write(word +"\n")
    fichier2.close()

def addlistBlack():
    liste= open("textlist")
    fichier= open("badwords", mode="r+")
    whitelist=open("frenchtest")
    contenuBlack=fichier.read()
    tabBlack=word_tokenize(contenuBlack)

    contenuWhite= whitelist.read()
    tabwhite= word_tokenize(contenuWhite)

    contenuList= liste.read()
    new = word_tokenize(contenuList.lower())
    new2=db(new)

    liste.close()
    for word in new2:
            if not Isinside(word, tabwhite):
                    if not Isinside(word , tabBlack):
                        fichier.write(word +"\n")
    fichier.close()


def seek(word):
    fichier= open("textlist", mode="r")
    Contenue=fichier.read()
    tab=word_tokenize(Contenue)
    for i in tab:
        tabmot=list(i)


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

def known(words): return set(w for w in words if w in WORDS)
