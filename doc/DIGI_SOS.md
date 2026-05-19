# 🛠️ DIGI_SOS - Sistema de Gestió d'Incidències (GI3P)

Aquest projecte consisteix en una aplicació web integral per a la gestió, control, assignació i monitorització d'incidències tècniques i actuacions en un centre educatiu. L'arquitectura és híbrida: utilitza un entorn relacional per a la lògica de negoci i un entorn NoSQL per a l'auditoria i analítica de seguretat.

## 📁 Estructura del Projecte

El codi font i els recursos del projecte s'organitzen dins de la carpeta principal del servidor web:
```
/
├── index.php                 # Pàgina d'inici, benvinguda i enrutament inicial
├── logs.php                  # Panell analític d'estadístiques i visualització de logs de seguretat
├── conexio.php               # Fitxer central de configuració i connexió (MySQL i MongoDB)
├── mongo.php                 # Script d'auditoria automatitzada (intercepció de peticions)
├── user/                     # Mòdul i panell dedicat al Professorat (creació i consulta)
├── tecnic/                   # Mòdul per als Tècnics (gestió d'incidències assignades i actuacions)
├── admin/                    # Mòdul de l'Administrador (control total, usuaris i configuració)
├── css/                      # Fulls d'estil visuals (Framework Bootstrap 5 i personalitzats)
├── js/                       # Fitxers de validació en JavaScript en el costat del client
└── img/                      # Recurs de gràfics, captures d'accessibilitat i logotips
```
---

## ⚙️ Funcionalitats Principals Implementades

### 1. Gestió d'Incidències (Model Relacional - MySQL)
- **Registre de tiquets:** Els professors poden donar d'alta incidències assignant-les al seu `DEPARTAMENT` i classificant-les per `tipo` i descripció.
- **Assignació de Tècnics:** L'administrador gestiona la cua de treball associant un `TECNIC` i modificant la `prioritat` (Alta, Mitja, Baixa).
- **Tancament d'incidències:** El sistema registra de manera automatitzada la `dataFinalitzacio` quan el tiquet es marca com a resolt.

### 2. Històric d'Actuacions (`ACTUACIO`)
- **Seguiment cronològic:** Cada incidència permet desar múltiples actuacions sequencials per detallar les reparacions fetes.
- **Control de privacitat:** L'atribut `visible` (0 o 1) determina si les notes internes del tècnic es mostren o s'oculten a l'usuari que va obrir la incidència.
- **Auditoria de temps:** Es comptabilitza la `duracio` en minuts per realitzar informes de rendiment.

### 3. Sistema de Logs Analítics (Model NoSQL - MongoDB Atlas)
- **Intercepció en temps real:** A través de `mongo.php`, cada accés guarda la `ip_origin`, la pàgina (`page`), el mètode HTTP (`GET/POST`), el navegador utilitzat i el rol de l'`usuari`.
- **Filtres Avançats:** Permet cercar i segmentar els registres d'auditoria per rangs exactes de dates i tipus d'usuari sense degradar el rendiment de la base de dades relacional principal.
