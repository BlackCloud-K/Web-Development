import sqlite3

conn = sqlite3.connect('/Users/keven/Documents/NYU/大三下/Web Dev/Assignment/Web-Development/MAMP/webdev/assignment_9/databases/user.db')

cursor = conn.cursor()

cursor.execute("SELECT name FROM sqlite_master WHERE type='table';")
print(cursor.fetchall())
conn.close()
