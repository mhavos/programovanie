import tkinter
from tkinter import font
#from prefixtree import PrefixTree as Trie
from radixtree import RadixTree as Trie

w, h, a, o = 1000, 600, 20, 5
trie = Trie()

def add(word):
    canvas.delete("all")
    trie.push(word.strip())
    trie.draw(canvas, w/2, a/2 + o, a, o)

def remove(word):
    canvas.delete("all")
    try:
        trie.remove(word)
    except ValueError:
        print(f"'{word}' not present in trie")
    trie.draw(canvas, w/2, a/2 + o, a, o)

def enter(event):
    add(entry.get())
    entry.delete(0, "end")

window = tkinter.Tk()
canvas = tkinter.Canvas(window, width=w, height=h)
entry = tkinter.Entry(window)
b_add = tkinter.Button(window, text="Add", command=lambda: add(entry.get()))
b_remove = tkinter.Button(window, text="Remove", command=lambda: remove(entry.get()))

canvas.pack(side="top")
entry.bind("<Return>", enter)
entry.pack()
b_add.pack()
b_remove.pack()

init_words = ["bro", "broccoli", "broth", "brother", "bruh", "widow", "win", "wind", "window", "word", "world"]
for word in init_words:
    trie.push(word)

trie.draw(canvas, w/2, a/2 + o, a, o)

window.mainloop()
