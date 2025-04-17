# 🎯 Gestion d'Événements & Inscriptions – PHP & MySQL

Ce projet est une application web développée en **PHP** avec une base de données **MySQL**.
Elle permet la **gestion d’événements** ainsi que l’**inscription de participants** via une interface simple, claire et organisée en trois couches (MVC simplifié).

---

## 👨‍💻 Réalisé par

**Mohcine Jaad**  
Étudiant en Systèmes d’Information & Intelligence Artificielle  
📧 Contact : *mohcine.jaad@gmail.com.com*

📘 Projet proposé par : **M. Youssouf EL ALLIOUI – USMS | FPK** *(enseignant encadrant)*

---

## 🔧 Fonctionnalités principales

- [x] Ajouter des événements
- [x] Inscrire un participant à un événement
- [x] Valider les données (format d’email, date, champs obligatoires)
- [x] Lister les événements disponibles
- [x] Afficher les inscriptions (nom, email, événement, date)

---

## 📁 Structure du projet

```
gestion_evenements/
├── config/
│   ├── Database.php
│   └── gestion_evenements.sql
├── controllers/
│   ├── EventController.php
│   ├── ParticipantController.php
│   └── InscriptionController.php
├── models/
│   ├── EventModel.php
│   ├── ParticipantModel.php
│   └── InscriptionModel.php
├── views/
│   ├── events/
│   │   ├── create_event.php
│   │   └── list_events.php
│   ├── participants/
│   │   └── register_inscriptions.php
│   ├── inscriptions/
│   │   └── list_inscriptions.php
│   ├── layout/
│   │   ├── footer.php
│   │   └── headr.php
│   └── index.php
└── public/
│   ├── css/
│   │   └── style.css
│   └── js/
│        └── script.js
└── README.md

```

---

## ⚙️ Installation rapide

1. **Cloner le projet :**
   ```bash
   git clone https://github.com/MohcineJAAD/gestion_evenements.git
   cd gestion-evenements

2. **Créer la base de données :**
   - Nom : `gestion_evenements`
   - Tables : `events`, `participants`, `inscriptions`

3. **Configurer la connexion à MySQL dans `config/Database.php` :**
   ```php
   private $username = 'root';
   private $password = '';
   private $db_name = 'gestion_evenements';
   ```

---

## 🛠 Technologies utilisées

- PHP orienté objet
- PDO (accès sécurisé à MySQL)
- HTML5 / CSS3
- Architecture MVC simplifiée

---

## 🔮 Améliorations possibles

- modifier / supprimer des événements
- Interface d’administration avec authentification
- Sécurité (anti-injection, CSRF)
- Recherche d’événements
- Pagination des listes
- Refactorisation en MVC complet avec routes automatiques

---

## 📄 Licence

Ce projet a été développé dans le cadre d’un module universitaire. Toute réutilisation pédagogique est libre avec mention de l’auteur.

---

## 🙏 Remerciements

Merci à **M. Youssouf EL ALLIOUI** pour la proposition et l’encadrement du projet.