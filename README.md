# Développer un plugin ITSM-NG1.5

ITSM-NG est doté d'un puissant moteur de plugin qui permet de modifier la majorité des pages du logiciel et d'en créer.
Les méthodes de création d'un plugin sont assez libre mais nécessite de suivre quelques standards.
(Cette page est liée a un [repo github](https://github.com/AntoineLemarchand/examplePlugin) contenant un exemple minimal)

## L'arborescence
L'arborescence des plugins ITSM-NG se présente de la sorte:
```
MyPlugin/
┣ front/
┣ inc/
┣ locales/
┣ */
┣ hook.php
┗ setup.php
```

### Les dossiers
* [front/](/front) contient les fichiers contenant les pages et formulaires du plugin.
* [inc/](/inc) contient les fichier contenant les classes et la logique du plugin.
* [locales/](/locales) contient les fichier de traduction (*.po, *.mo).
* Vous avez la liberté d'ajouter d'autres dossiers en veillant a garder l'arborescence compréhensible.

### Les fichiers

#### setup.php
setup.php défini la fiche d'identité et les vérifications d'installation du plugin.
il doit au moins contenir ces cinq fonctions ({MONPLUGIN} étant le nom de votre plugin):

* [`plugin_version_{MONPLUGIN}(): array`](/setup.php#L39): La fiche d'identité du plugin.
* [`plugin_init_{MONPLUGIN}(): void`](/setup.php#L84): pour initialiser les hooks du plugin.
* [`plugin_{MONPLUGIN}_check_prerequisites(): bool`](/setup.php#L62): Vérification des dépendances nécessaire au plugin AVANT l'installation.
* [`plugin_{MONPLUGIN}_check_config($verbose = false): bool`](/setup.php#L75): Vérification de la configuration nécessaire au plugin AVANT l'installation.
Il est aussi encouragé de charger la version du plugin dans une constance [`{MONPLUGIN_VERSION}`](https://github.com/AntoineLemarchand/examplePlugin/blob/main/setup.php#L30)

#### hook.php
hook.php contient la définition des hooks du plugin.
il doit au moins contenir ces deux fonctions ({MONPLUGIN} étant le nom de votre plugin):

* [`plugin_{MONPLUGIN}_install(): bool`](https://github.com/AntoineLemarchand/examplePlugin/blob/main/hook.php#L31): créer les bases de données du plugin et effectue les étapes nécessaire a son l'installation.
* [`plugin_{MONPLUGIN}_uninstall(): bool`](https://github.com/AntoineLemarchand/examplePlugin/blob/main/hook.php#L40): supprime les bases de données du plugin et effectue les étapes nécessaire a son l'installation.

## Convention de nommage
Le système de plugin est sensible au nommage des fichier et des classes, ainsi, un fichier qui s'appelle `{NOMDUFICHIER}.php` ou `{NOMDUFICHIER}.*.php` doit contenir une classe qui se nomme `Plugin{NOMDUPLUGIN}{NOMDUFICHIER}`
Sinon, elle ne sera pas detectée par le logiciel.

Les tables créées par le plugin doivent toutes avoir un nom commencant par `glpi_plugin_{NOMDUPLUGIN}_`

## Configuration

Pour customiser le fil d'ariane et les boutons du header de chaque pages,
il est possible d'ajouter dans leur header un fichier de configuration ([`/inc/config.class.php`](https://github.com/AntoineLemarchand/examplePlugin/blob/main/inc/config.class.php))
Celui-ci peut aussi encapsuler le fichier front lors de l'ajout d'un champ dans la barre de navigation par exemple ([comme ici](https://github.com/AntoineLemarchand/examplePlugin/blob/main/setup.php#L90))

Ce fichier contient en particulier la fonction `getMenuContent` qui retourne un objet contenant:
* le titre de la page
* la page a rediriger
* l'icone a afficher dans le champ ou dans le fil d'ariane

## Gestion des droits
Pour gérer les droits d'un plugin, celui-ci doit créer une table de profile nommée `glpi_plugin_{NOMDUPLUGIN}_profiles` dans le fichier `hook.php`.
Le plugin doit aussi contenir un fichier `/inc/profile.class.php` qui contient la logique d'attribution des droits, le code dans le repo d'exemple donne
les droit de modifications a celui qui installe le plugin, qu'il peut alors gérer dans la partie `administration>profiles>management`
