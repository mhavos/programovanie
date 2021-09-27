class Trie:
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
                return (width - 1)*(a + o) + a
            start = x - w(self.width)/2
            for key in self.children:
                child = self.children[key]
                xc, yc = start + w(child.width)/2, y + a + o
                canvas.create_line(x, y, xc, yc)
                child.draw(canvas, xc, yc, a, o)
                start += w(child.width) + o
            if self.key == None:
                canvas.create_rectangle(x - 3*a/2, y - a/2, x + 3*a/2, y + a/2, fill="white")
                canvas.create_text(x, y, text="root")
            else:
                canvas.create_oval(x - a/2, y - a/2, x + a/2, y + a/2, fill="white")
                if self.is_end:
                    canvas.create_oval(x - a/2 + 2, y - a/2 + 2, x + a/2 - 2, y + a/2 - 2, fill="white")
                canvas.create_text(x, y, text=self.key)

        def compute_width(self):
            if len(self.children) == 0:
                self.width = 1
                return self.width
            self.width = 0
            for key in self.children:
                self.width += self.children[key].compute_width()
            return self.width

    def __init__(self):
        self.root = Trie.Node(None)

    def push(self, word):
        current = self.root
        for letter in word:
            if letter in current.children:
                current = current.children[letter]
            else:
                new = Trie.Node(letter, parent = current)
                current.children[letter] = new
                current = new
        current.is_end = True

    def contains(self, word):
        current = self.root
        for letter in word:
            if letter in current.children:
                current = current.children[letter]
            else:
                return False
        return current.is_end

    def remove(self, word):
        current = self.root
        for letter in word:
            if letter in current.children:
                current = current.children[letter]
            else:
                raise ValueError(word)
        if not current.is_end:
            raise ValueError(word)
        current.is_end = False
        while current is not self.root:
            if len(current.children):
                return
            key = current.key
            current = current.parent
            current.children.pop(key)

    def draw(self, canvas, x, y, a, o):
        self.root.compute_width()
        self.root.draw(canvas, x, y, a, o)
