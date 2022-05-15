def vypis(meno_suboru: str, sirka: int, zarovnat: bool = True, slovo: str = ""):
    with open(meno_suboru, "r") as file:

        # spracuj text do odsekov:
        odseky = []
        current = []
        for line in file:
            words = line.strip().split()
            if current and not words:
                odseky.append(current)
                current = []
            else:
                current += words

        if current:
            odseky.append(current)

        spracovane = []
        for odsek in odseky:
            if slovo != "" and slovo not in odsek:
                continue

            odsek = odsek[::-1]
            riadky = []
            riadok = []
            zatial = -1
            while True:
                if not odsek:
                    riadky.append(" ".join(riadok))
                    break
                elif zatial < 0 or zatial + len(odsek[-1]) + 1 <= sirka:
                    riadok.append(odsek.pop())
                    zatial += len(riadok[-1]) + 1
                else:
                    if not zarovnat or zatial >= sirka:
                        riadky.append(" ".join(riadok))
                    else:
                        zostava = sirka - zatial
                        kazdy = zostava // (len(riadok) - 1) + 1
                        extra = zostava % (len(riadok) - 1) + 1
                        riadky.append( (" "*kazdy + " ").join(riadok[:extra]) + " "*kazdy + (" "*kazdy).join(riadok[extra:]) )
                    riadok = []
                    zatial = -1

            spracovane.append("\n".join(riadky))
        print("\n\n".join(spracovane))

for args in ((20,), (60,), (45, False), (45, True, "kvety")):
    print(f"\n\n----   vypis('subor1.txt', {', '.join(map(repr, args))})   ----\n")
    vypis("zarovnavanie/subor1.txt", *args)
