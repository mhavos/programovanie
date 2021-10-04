import tkinter
from graph import Graph

window = tkinter.Tk()
canvas = tkinter.Canvas(window, width=1000, height=700, bg="white")
canvas.pack(side="bottom")

label = tkinter.Label(window, text="edge weight")
entry = tkinter.Entry(window)
label.pack(side="top")
entry.pack(side="top")

graph = Graph()

marked = None
def handler(event):
    global marked
    clicked = None
    for vertex in graph.vertices:
        if (event.x - vertex.x)**2 + (event.y - vertex.y)**2 <= Graph.r**2:
            clicked = vertex
            break
    if clicked is None:
        return new_node(event)
    elif marked is not None:
        if marked is not clicked:
            connect(marked, clicked)
        mark(marked)
        marked = None
        return
    else:
        marked = clicked
        mark(clicked)

def mark(vertex):
    if vertex.color == "silver":
        vertex.color = "red"
    else:
        vertex.color = "silver"
    graph.draw(canvas)

def new_node(event):
    graph.vertex(event.x, event.y)
    graph.draw(canvas)

def connect(v1, v2):
    weight = entry.get()
    if weight == "":
        weight = ( (v1.x - v2.x)**2 + (v1.y - v2.y)**2 )**0.5
    graph.connect(v1, v2, int(weight))
    graph.draw(canvas)

def remove(event):
    global marked
    clicked = None
    for vertex in graph.vertices:
        if (event.x - vertex.x)**2 + (event.y - vertex.y)**2 <= Graph.r**2:
            clicked = vertex
            break
    if clicked is None:
        return
    graph.remove(clicked)
    if marked is clicked:
        marked = None
    graph.draw(canvas)

canvas.bind("<Button-1>", handler)
canvas.bind("<Button-3>", remove)
window.mainloop()
