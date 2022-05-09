def lez(noha, ruka):
    if ruka == 10:
        return 1
    elif ruka >= 10:
        return 0
    total = 0
    for novanoha in range(noha + 1, ruka):
        total += lez(novanoha, ruka)
    for novaruka in range(ruka + 1, noha + 4):
        total += lez(noha, novaruka)
    return total

print(lez(1, 3))
