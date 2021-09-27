class Dictionary:
    class LinkedList:
        class Node:
            def __init__(self, key, val, next = None, prev = None):
                self.key = key
                self.val = val
                self.next = next
                self.prev = prev

        def __init__(self, i=None):
            self.head = None
            self.tail = None

        def append(self, key, val):
            last = self.tail
            self.tail = Dictionary.LinkedList.Node(key, val, prev = last)
            if last is None:
                self.head = self.tail
            else:
                last.next = self.tail

        def __getitem__(self, key):
            current = self.head
            while current is not None:
                if current.key == key:
                    return current.val
                current = current.next
            raise KeyError(key)

        def __setitem__(self, key, val):
            current = self.head
            while current is not None:
                if current.key == key:
                    current.val = val
                    return
                current = current.next
            self.append(key, val)

    def __init__(self, capacity = 100):
        self.capacity = capacity
        self.data = [Dictionary.LinkedList(i) for i in range(self.capacity)]
        self.length = 0

    def __setitem__(self, key, val):
        h = hash(key) % self.capacity
        self.data[h][key] = val

    def __getitem__(self, key):
        h = hash(key) % self.capacity
        return self.data[h][key]

    def __len__(self):
        return self.length

a = Dictionary()
a[0] = "nula"
a[True] = "pravda"
print(f"{a[0] = }")
print(f"{a[True] = }")
print(f"{a['aa'] = }")
