# Interview task #2

Create a TODO app with a command line interface.

THe app should support following actions:
* add an item
* remove an item
* mark an item as done
* list items
* the app should support adding/removing multiple items at once

Once an item marked as DONE, save the current date to be able to show simple statistic to the user, e.g:
```
2022.10.05: you've completed 5 tasks!
2022.11.11: you've completed 4 tasks!
...
```
Store the TODO items on disk, so the user can list the saved items at any moment. Use any persistent storage you want (JSON, CSV, Database, etc)
