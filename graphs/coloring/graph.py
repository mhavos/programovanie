from collections import deque

class Container:
    def __init__(self, val, data, prev=None):
        self.val = val
        self.data = data
        self.prev = prev

    def __lt__(self, other):
        return self.val < other.val

    def __le__(self, other):
        return self.val <= other.val

class Graph:
    r = 20

    class Vertex:
        id = 0

        def __init__(self, x, y):
            self.neighbors = {}
            self.color = "silver"
            self.id = Graph.Vertex.id
            Graph.Vertex.id += 1
            self.x = x
            self.y = y

        def link_to(self, other, weight):
            self.neighbors[other] = weight
            other.neighbors[self] = weight

        def remove(self):
            for other in self.neighbors:
                other.neighbors.pop(self)
                self.neighbors = {}

        def __hash__(self):
            return self.id

    def __init__(self):
        self.vertices = []

    def vertex(self, x, y):
        self.vertices.append(Graph.Vertex(x, y))

    def connect(self, v1, v2, weight):
        v1.link_to(v2, weight)

    def draw(self, canvas):
        canvas.delete("all")
        for v1 in self.vertices:
            for v2 in v1.neighbors:
                if v2.id < v1.id:
                    continue
                self.create(canvas, v1, v2)
            self.create(canvas, v1)

    def remove(self, vertex):
        vertex.remove()
        self.vertices.remove(vertex)

    def recolor(self, clicked, canvas):
        self.bfs(clicked, canvas)
        self.draw(canvas)

    def bfs(self, start, canvas, colors=["red", "blue", "green", "cyan", "magenta", "yellow"], first=True):
        l = deque([start])
        for v in self.vertices:
            v.visited = False
            v.colorable = True
            if first:
                v.color = None
        nextiter = None
        start.visited = True
        done = True
        while l:
            current = l.popleft()
            if current.color is None:
                done = False
                if current.colorable:
                    current.color = colors[0]
            for next in current.neighbors:
                if current.color == colors[0]:
                    next.colorable = False
                if not next.visited:
                    l.append(next)
                    if nextiter is None:
                        nextiter = next
                next.visited = True
        if not done:
            self.bfs(nextiter, canvas, colors=colors[1:], first=False)

    def trace(self, canvas, v2):
        self.draw(canvas)
        current = v2
        while current.prev != None:
            self.create(canvas, current, current.prev, thick=1)
            self.create(canvas, current, thick=1)
            current = current.prev
        self.create(canvas, current, thick=1)

    def create(self, canvas, v1, v2=None, thick=0):
        width = 1 + 2*thick
        if v2 is not None:
            canvas.create_line(v1.x, v1.y, v2.x, v2.y, width=width)
            lx, ly = (v1.x + v2.x)/2, (v1.y + v2.y)/2
            canvas.create_rectangle(lx - 20, ly - 10, lx + 20, ly + 10, fill="white", outline="white")
            canvas.create_text(lx, ly, text=str(v1.neighbors[v2]))
        else:
            canvas.create_oval(v1.x - Graph.r, v1.y - Graph.r, v1.x + Graph.r, v1.y + Graph.r, fill=v1.color, width=width)
            canvas.create_text(v1.x, v1.y, text=str(v1.id))
