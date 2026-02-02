### Utilisation de Docker pour tester le projet

#### Modfication des permission

Uniquement pour linux les permissions doivent être appliquées pour que le container
puisse ecrire dans le repertoire assets ( Sauvegarde des avatars )

```bash
sudo chown -R 33:33 assets
```

Lancer la stack avec
```bash
cd docker
docker compose up -d --build
```

### Se rendre sur adminer depuis un navigateur web

[http://localhost/8081](http://localhost/8081)

Se logger en tant que : 
``` 
    utilisateur : root
    Mot de passe : root
```
Mettre en place la base de données contenue dans le fichier

[database/creation.sql](database/creation.sql)

ainsi que les données de test

[database/donnees.sql](database/donnees.sql)

Pour cela dans l'interface Adminer, clicker sur 'Requête SQL', Copier le contenu des deux fichiers l'un après l'autre dans la zone de saisie

Clicker sur 'Exécuter'

A ce point La structure de la base de données ainsi qu'un ensemble de données de test sont en place.

### Se rendre sur le site depuis un navigateur web

[http://localhost:8080](http://localhost:8080)

### Pour arrêter la stack docker

```bash
docker compose down
```

### Trois comptes on été crées dans la base de données d"exemple

Nom : paul
Email : paul@example.com
PassWord : abcdefgh

et 

Nom : martin
Email : martin@example.com
PassWord : abcdefgh
