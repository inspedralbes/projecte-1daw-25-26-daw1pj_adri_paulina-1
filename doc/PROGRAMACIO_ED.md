# 📊 Programació i Entorns de Desenvolupament

Per al correcte desenvolupament d'aquesta aplicació web s'ha seguit una metodologia de treball àgil i s'han emprat eines de control de versions professional per coordinar el desplegament.

## 🗺️ 1. Planificació del Projecte (Sprints)

El cicle de vida del projecte s'ha estructurat en **3 Sprints** de treball continu:

- **Sprint 1 (Fase d'Infraestructura i Usuari):** Disseny i creació del model relacional SQL (`DEPARTAMENT`, `TECNIC`). Implementació del fitxer de connexió de base de dades i primer formulari de creació d'incidències per al rol de professor.
- **Sprint 2 (Lògica de Negoci i Tècnic):** Creació de les vistes d'administració i gestió de tècnics. Implementació de la taula `ACTUACIO` per enllaçar notes de treball, temps invertit en minuts i estats de visibilitat.
- **Sprint 3 (Auditoria i Analítica):** Integració del driver de MongoDB. Desenvolupament del fitxer d'auditoria automatitzada `mongo.php` i creació del panell visual d'estadístiques amb gràfiques diàries cronològiques (`logs.php`).

---

## 🌿 2. Gestió del Codi amb Git (Control de Versions)

S'ha establert un flux de treball basat en branques per evitar conflictes de codi en producció:
- **Branca `main` / `master`:** Conté exclusivament el codi totalment funcional i auditat. És la branca que es lliura finalment.
- **Branca `feature-sql`:** Utilitzada per muntar les consultes i inserts de les incidències.
- **Branca `feature-mongodb`:** Destinada exclusivament a la integració del fitxer `vendor/autoload.php`, la connexió amb la URI d'Atlas i el processament de les gràfiques de línia.

---

## 🛠️ 3. Entorn de Desenvolupament Local

Per garantir que l'aplicació funciona exactament igual a l'ordinador de qualsevol membre de l'equip de treball, s'ha centralitzat l'entorn mitjançant la següent pila tecnològica:
- Servidor Web Apache amb intèrpret de PHP 8.x.
- Servidor de base de dades MySQL/MariaDB per a la gestió estructural del centre.
- Connexió remota TLS segura cap al clúster de **MongoDB Atlas** al núvol per al buidatge i consulta de logs d'auditoria.