def mergesort(l: list) -> list:
    if len(l) == 1:
        return l

    m: int = len(l)//2
    l1: list = mergesort(l[:m])[::-1]
    l2: list = mergesort(l[m:])[::-1]

    l = []
    while l1 or l2:
        if not l1:
            l.append(l2.pop())
        elif not l2 or l1[-1] < l2[-1]:
            l.append(l1.pop())
        else:
            l.append(l2.pop())

    return l

import random
unsorted = [random.randrange(0, 100) for i in range(20)]
sorted = mergesort(unsorted)
print(f"{unsorted = }\n{sorted = }")
