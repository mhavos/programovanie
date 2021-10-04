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
                canvas.create_line(v1.x, v1.y, v2.x, v2.y)
                lx, ly = (v1.x + v2.x)/2, (v1.y + v2.y)/2
                canvas.create_rectangle(lx - 20, ly - 10, lx + 20, ly + 10, fill="white", outline="white")
                canvas.create_text(lx, ly, text=str(v1.neighbors[v2]))
            canvas.create_oval(v1.x - Graph.r, v1.y - Graph.r, v1.x + Graph.r, v1.y + Graph.r, fill=v1.color)
            canvas.create_text(v1.x, v1.y, text=str(v1.id))

    def remove(self, vertex):
        vertex.remove()
        self.vertices.remove(vertex)
