# GI3P - Gestió d'Incidències Informàtiques Institut Pedralbes

## Grup2 - 1r DAW 2025-26

### Integrantes
- Adrián Tomás
- Paulina Barrera

### Objectiu del Projecte
Sistema web per a la gestió d'incidències informàtiques de l'Institut Pedralbes, 
permetent que professors reportin problemes, tècnics els solucinin i administradors 
supervisen el procés.

### Estat del Projecte
**EN PRODUCCIÓ**

#### Funcionalitats Implementades
- Registre de incidències
- Llistats d'incidències
- Panel de tècnics
- Panel d'administrador
- Sistema de logs amb MongoDB
- Estadístiques d'accés
  
### Accés
- **URL Producció:** http://grup2.daw.inspedralbes.cat
- **Documentació PHPDoc:** http://grup2.daw.inspedralbes.cat/docs
- **Video demo:** https://drive.google.com/file/d/1bTqiTqe2Wa0HXurf-94SPJGI5furUWzZ/view?usp=drive_link

### Tecnologies
- Backend: PHP 7.4+ (procedural)
- Frontend: HTML5, CSS3, Bootstrap 5, JavaScript
- BD Relacional: MySQL
- BD Document: MongoDB Atlas
- Servidor: Apache
### Estructura del Projecte
```
/
├── index.php           # Pàgina principal
├── logs.php            # Estadístiques
├── conexio.php         # Connexió a BD
├── user/               # Panell professor
├── tecnic/             # Panell tècnic
├── admin/              # Panell administrador
├── css/                # Estils
├── js/                 # Scripts
└── img/                # Imatges
```

### Validació WCAG AA
- ✅ Formulari de crear incidència: AA
- ✅ Llistat d'incidències: AA

### Equip i Commits
- **Bitàcora:** https://docs.google.com/spreadsheets/d/1SL9not5epc_ZAFcZTmjhofyzik6h5wyrPeDjpOKwPV4/edit?gid=1551247593#gid=1551247593
- **TAIGA:** https://tree.taiga.io/project/a25adrtomdie-daw1pj2/backlog
