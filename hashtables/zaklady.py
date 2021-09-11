class Data:
    def __init__(self, name):
        self.name = name

    def hash(self, n):
        sum = 0
        for char in self.name:
            sum += ord(char)
        return sum % n

    def __repr__(self):
        return f"({self.name}, {self.hash(10)})"

    def __eq__(self, other):
        if type(self) != type(other):
            return False
        return self.name == other.name

class HashTable:
    def __init__(self, n):
        self.n = n
        self.data = [None for i in range(n)]

    def push(self, data):
        hash = data.hash(self.n)
        for i in range(hash, hash + self.n):
            if self.data[i % self.n] == None:
                self.data[i % self.n] = data
                return
        raise IndexError("HashTable is full")

    def lookup(self, data):
        hash = data.hash(self.n)
        for i in range(hash, hash + self.n):
            if self.data[i % self.n] == data:
                return i % self.n
        raise ValueError("HashTable does not contain the requested data")

    def print(self):
        for d in self.data:
            print(d)

ht = HashTable(10)

for name in ["Misko", "Ferko", "Anna", "Igor", "Karol", "Yeetus", "Havos"]:
    ht.push(Data(name))

ht.print()
print(ht.lookup(Data(input())))
