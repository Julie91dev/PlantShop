# PlantShop
##Projet en cours
Projet perso de site eCommerce de plante
Le but étant d'apprendre et de pratiquer le framework symfony

### Installation

1. Naviguer vers votre dossier web, ici utilisation de WampServer

	 cd /Wamp64/www/

2. Cloner le projet

	`https://github.com/Julie91dev/PlantShop.git plantshop`

3. Naviguer dans le répertoire du projet

	`cd plantshop`

4. Installer les dépendances

	`composer install`

5.Configurer la base de données dans le fichier `.env`

6. créer la base de données

	`php bin/console doctrine:database:create`
	
	`php bin/console doctrine:schema:update --force`


7.Importer le fichier 'plantshop-data.sql' dans la base donnée

8. Naviguer vers `http://localhost/PlantShop/public/`


### Comptes

##### compte user
mail: test@test.fr

mdp: test123

##### compte admin

mail: admin@admin.fr

mdp: adminadmin


### Tests

Pour lancer des tests unitaires et fonctionnels définis dans le répertoire /tests
`php bin/phpunit`
