# 🔐 Système d'Authentification Multi-Rôles en MVC (PHP)

## 📌 Présentation du projet

Ce projet consiste à concevoir et développer un **système d'authentification multi-rôles** en **PHP natif**, basé sur une **architecture MVC en couches**, sans framework.

Il constitue le socle technique de la plateforme **TalentHub**, une application de recrutement permettant de connecter **candidats**, **recruteurs** et **administrateurs**.

L'objectif principal est de fournir une architecture **propre, sécurisée, maintenable et réutilisable**, destinée à supporter les futures fonctionnalités métier.

---

## 🎯       Objectifs

- Implémenter une architecture MVC "from scratch"
- Mettre en place un routage centralisé
- Gérer l'authentification utilisateur
- Gérer plusieurs rôles avec des accès différenciés
- Sécuriser l'accès aux routes selon le rôle
- Respecter les bonnes pratiques de sécurité backend

---

## 🧠 Architecture

### Flux de requête

public/index.php
↓
Router
↓
Controller
↓
Service
↓
Model / Repository
↓
View


### Principes respectés

- ✅ Un seul point d'entrée (`public/index.php`)
- ✅ Séparation stricte des responsabilités
- ❌ Aucune logique métier dans les vues
- ❌ Aucun SQL dans les contrôleurs
- ❌ Aucun accès direct aux fichiers

---

## 👥 Rôles du système

### 👤 Candidate
- Inscription
- Connexion
- Accès au dashboard candidat

### 🏢 Recruiter
- Inscription
- Connexion
- Accès au dashboard recruteur

### 🛡️ Admin
- Connexion uniquement (pas d'inscription publique)
- Accès au back-office admin
- Vues et routes totalement isolées

Chaque rôle possède :
- Ses propres routes (`/candidate/*`, `/recruiter/*`, `/admin/*`)
- Son propre contrôleur
- Ses propres vues protégées

---

## ⚙️ Fonctionnalités

### 🔐 Authentification
- Inscription (Candidate & Recruiter)
- Connexion (tous les rôles)
- Déconnexion
- Gestion de session PHP
- Hashage des mots de passe (`password_hash()`)

### 🔑 Gestion des rôles
- Attribution automatique du rôle
- Stockage du rôle en session
- Redirection dynamique après connexion
- Vérification du rôle à chaque requête

### 🚫 Protection des routes
- Routes publiques :
  - `/`
  - `/login`
  - `/register`
- Routes protégées :
  - `/candidate/*`
  - `/recruiter/*`
  - `/admin/*`

Redirection automatique vers :
- Page de connexion
- Page 403 (Accès refusé)

---

## 🗂️ Structure des dossiers

talenthub-auth/
├── public/
│   └── index.php                    # Point d'entrée unique
│
├── src/
│   ├── Controllers/
│   │   ├── AuthController.php       # Gestion inscription/connexion
│   │   ├── CandidateController.php  # Dashboard candidat
│   │   ├── RecruiterController.php  # Dashboard recruteur
│   │   └── AdminController.php      # Dashboard admin
│   │
│   ├── Services/
│   │   └── AuthService.php          # Logique métier auth
│   │
│   ├── Models/
│   │   ├── User.php                 # Entité User
│   │   └── Role.php                 # Entité Role
│   │
│   ├── Repositories/
│   │   ├── UserRepository.php       # Persistence User
│   │   └── RoleRepository.php       # Persistence Role
│   │
│   ├── Views/
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   └── register.php
│   │   ├── candidate/
│   │   │   └── dashboard.php
│   │   ├── recruiter/
│   │   │   └── dashboard.php
│   │   ├── admin/
│   │   │   └── dashboard.php
│   │   └── errors/
│   │       └── 403.php
│   │
│   ├── Router.php                   # Gestion des routes
│   └── Database.php                 # Connexion PDO
│
├── config/
│   └── database.php                 # Configuration BDD
│
├── sql/
│   └── schema.sql                   # Script de création des tables
│
└── README.md


---

## 🧩 UML

### Diagrammes fournis
- 📌 Diagramme de cas d'utilisation
- 📌 Diagramme de classes

### Entités principales
- **User** (id, name, email, password, role_id)
- **Role** (id, name)

---

## 🔐 Sécurité

### Implémenté
- ✔ Hashage des mots de passe
- ✔ Requêtes préparées PDO
- ✔ Validation des entrées utilisateur
- ✔ Vérification de session
- ✔ Protection XSS & CSRF
- ✔ Messages d'erreur non sensibles

### Interdit (respecté)
- ❌ Mots de passe en clair
- ❌ SQL dans les contrôleurs
- ❌ Rôles hardcodés
- ❌ Code procédural

---

## 🎁 Bonus (optionnels)

- Remember Me (cookie sécurisé)
- Logger des tentatives de connexion
- Validation JavaScript côté client
- Page 404 personnalisée

---

## 🚀 Installation

1. Cloner le repository
```bash
git clone https://github.com/username/project-name.git
