def hash(meno):
    sum = 0
    for char in meno:
        sum += ord(char)
    return sum % 100

def printdata():
    for d in data:
        print(d)

data = []
for i in range(100):
    data.append([])

for name in ["Misko", "Ferko", "Anna", "Igor", "Karol", "Ingrid"]:
    data[hash(name)] = [name]
printdata()
