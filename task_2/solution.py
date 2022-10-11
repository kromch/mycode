#!/usr/bin/env python
 
def clear():
    from os import system, name
    if name == 'nt':
        _ = system('cls')
    else:
        _ = system('clear')

def read_key(message='', rgsz=6):
    import time
    try:
        import msvcrt
        ch = msvcrt.getch()
    except:
        ch = sys.stdin.read(1)
    if len(message)==0:
        try:
            ch = int(ch)
            if ch<1 or ch>rgsz:
                raise Exception("") 
        except ValueError:
            print("Type mismatch")
        except:
            print("Allowed only digit between 1 to {0}. Re-input, please.".format(rgsz))
        else:
            print(ch)
    else: print(message)
    time.sleep(1)
    return ch
    
def input_item():
    val = input("Input Item context value : ")
    if len(val):
        storage.append(dict(value=val, time=datetime.datetime.now().strftime("%d-%m-%Y %H:%M"), done=0))
    else:
        print("Empty value not will be add")
    read_key("Press any key to continue...")

def remove_item():
    print("Input numeric position to remove of storage Item from 1 to {0}:".format(len(storage)))
    ch = read_key("",len(storage)) - 1
    del storage[ch]
    print("Item {0} of storage is removed".format(ch+1))
    read_key("Press any key to continue...")

def mark_item():
    print("Input numeric position to mark of storage Item from 1 to {0}:".format(len(storage)))
    ch = read_key("",len(storage)) - 1
    storage[ch]["done"]+=1
    storage[ch]["time"] = datetime.datetime.now().strftime("%d-%m-%Y %H:%M")
    print("Item {0} of storage is marked".format(ch+1))
    read_key("Press any key to continue...")

def print_items():
    j = 1; buf = ''
    for st in storage:
        buf+=str(j)+". -> "+str(st)+",\n"
        j+=1
    print(buf)    
    print("Items printed by order in storage of Items")
    read_key("Press any key to continue...")

def save_items():
    import json
    with open("save.json","w") as file:
        file.write(json.dumps(storage))
    print("Items saved to save.json file")
    read_key("Press any key to continue...")

storage=[]
menu = """
Operations:

1. Add an item
2. Remove an item
3. Mark an item as done
4. List items
5. Persistent save items
6. Exit

Input your choice (1-6 digit):
"""
import sys
import datetime
while True:
    clear()
    print(menu)
    while True:
        print(">", end =" ")
        ch = read_key()
        match ch:
            case 1:
                input_item()
            case 2:
                remove_item()
            case 3:
                mark_item()
            case 4:
                print_items()
            case 5:
                save_items()
            case 6:
                print("Good bye, fellow")
                sys.exit()
        break