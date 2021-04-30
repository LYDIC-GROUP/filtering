# FILTERING

Enables parsing of expression's to a set of easy to navigate nodes.

## Syntax
The syntax is basic, a single filter looks like this:
```
<property>:<operator>:<value>
name:eq:willem
```

You can chain multiple filters together:
```
<property>:<operator>:<value> <logic> <property>:<operator>:<value>
name:eq:willem AND age:gt:10
```

You can also group filters together:
```
<property>:<operator>:<value> <logic> (<property>:<operator>:<value> <logic> <property>:<operator>:<value>)
name:eq:willem AND (age:gt:10 OR city:neq:amsterdam)
```

### Operators

| Operator   | Description         |
| ---------- | ------------------- |
| eq         | Equals              |
| neq        | Not Equals          |
| gt         | Greater then        |
| lt         | Less then           |
| gte        | Greater then equals |
| lte        | Loss then equals    |
| like       | Like                |

### Logic operators

| Operator   | Description         |
| ---------- | ------------------- |
| AND        | Should i explain?   |
| OR         | Should i explain?   |

## Planned features
- Date operators
- Better error handling

[Hey 👋 If you like our libraries. Support us by buying us a coffee!](https://www.buymeacoffee.com/LYDICGROUP)
