from tkinter import font
inf = float("inf")
column = False

def match(a, b):
    shorter = min(len(a), len(b))
    for i in range(shorter):
        if a[i] != b[i]:
            return i
    return shorter

class RadixTree:
    class Node:
        def __init__(self, key, parent=None, children=None, is_end=False):
            if children == None:
                children = {}
            self.key = key
            self.parent = parent
            self.children = children
            self.is_end = is_end

        def draw(self, canvas, x, y, a, o):
            def w(width):
                return width
            start = x - w(self.width)/2
            for key in self.children:
                child = self.children[key][1]
                xc, yc = start + w(child.width)/2, y + a + o
                if not column:
                    canvas.create_line(x, y, xc, yc-a/2)
                child.draw(canvas, xc, yc, a, o)
                start += w(child.width) + o

            bw = self.width if column else self.boxwidth
            canvas.create_rectangle(x - bw/2, y - a/2, x + bw/2, y + a/2, fill="white")
            if self.is_end:
                canvas.create_rectangle(x - bw/2, y + a/2 - 2, x + bw/2, y + a/2, fill="white")
            canvas.create_text(x, y, text=self.key)

        def compute_width(self, a, o):
            self.boxwidth = defaultfont.measure(str(self.key)) + a/2
            if len(self.children) == 0:
                self.width = self.boxwidth
                return self.width
            self.width = -o
            for key in self.children:
                self.width += self.children[key][1].compute_width(a, o) + o
            self.width = max(self.width, self.boxwidth)
            return self.width

    def __init__(self):
        self.root = RadixTree.Node("ε")

    def push(self, word):
        current = self.root
        while word:
            if word[0] in current.children:
                prefix, child = current.children[word[0]]
                m = match(prefix, word)
                if m == len(prefix):
                    current = child
                    word = word[len(prefix):]
                else:
                    key, word = word[:m], word[m:]
                    new = RadixTree.Node(key, parent = current)
                    old = current.children[key[0]][1]
                    current.children[key[0]] = key, new
                    current = new
                    current.children[old.key[m]] = old.key[m:], old
                    old.key = old.key[m:]
                    old.parent = new
            else:
                new = RadixTree.Node(word, parent = current)
                current.children[word[0]] = word, new
                word = ""
                current = new
        current.is_end = True

    def contains(self, word):
        current = self.root
        while word:
            if word[0] in current.children:
                prefix, child = current.children[word[0]]
                if match(prefix, word) == len(prefix):
                    current = child
                    word = word[len(prefix):]
                else: return False
            else: return False
        return current.is_end

    def remove(self, word):
        current = self.root
        fullword = word
        while word:
            if word[0] in current.children:
                prefix, child = current.children[word[0]]
                if match(prefix, word) == len(prefix):
                    current = child
                    word = word[len(prefix):]
                else: raise ValueError(fullword)
            else: raise ValueError(fullword)
        if not current.is_end:
            raise ValueError(word)
        current.is_end = False
        while current is not self.root:
            if len(current.children) > 1 or current.is_end:
                return
            elif len(current.children) == 1:
                for key in current.children: prefix, child = current.children[key]
                prefix = current.key + prefix
                child.key = prefix
                child.parent = current.parent
                current.parent.children[prefix[0]] = prefix, child
                return
            else:
                key = current.key
                current = current.parent
                current.children.pop(key[0])

    def draw(self, canvas, x, y, a, o):
        global defaultfont
        defaultfont = font.nametofont("TkDefaultFont")

        self.root.compute_width(a, o)
        self.root.draw(canvas, x, y, a, o)
