filename = "./input.txt"
with open(filename) as f:
   content = f.read().split("\n\n")
   content = [elem.split("\n") for elem in content]

total = 0
for string_list in content:
    list_length = len(string_list)
    joined_string = ''.join(string_list)
    checked_letters = []
    for letter in joined_string:
        if joined_string.count(letter) == list_length and letter not in checked_letters:
            checked_letters.append(letter)
    total += len(checked_letters)

print(total)