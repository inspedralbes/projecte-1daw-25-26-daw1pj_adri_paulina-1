# 🌐 Llenguatges de Marques i Funcionalitats JavaScript

En aquest projecte s'ha emprat JavaScript en el costat del client per millorar l'experiència d'usuari (UX), validar les dades introduïdes abans de fer l'enviament al servidor (evitant així peticions innecessàries) i renderitzar gràfiques interactives de consum.

## 📊 1. Integració de Llibreries Dinàmiques (Chart.js)

El panell de control estadístic de l'aplicació (`logs.php`) utilitza la llibreria **Chart.js** mitjançant la injecció directa de vectors estructurats en JSON des del backend en PHP. S'han configurat i renderitzat dues gràfiques:

- **`trendChart` (Tipus Line):** Mostra l'històric d'accessos cronològics distribuïts per dies. S'ha configurat amb l'opció `tension: 0.4` per suavitzar la línia de tendència i un fons translúcid combinat (`backgroundColor: 'rgba(24, 95, 165, 0.1)'`).
- **`pieChart` (Tipus Doughnut):** Analitza de forma percentual el pes de cada rol d'usuari dins del sistema (Administrador, Tècnic, Professor, Anònim) aplicant la propietat `cutout` per generar un disseny modern d'anell.

---

## 🛡️ 2. Validació de Formularis (Seguretat en Client)

S'han programat funcions de JavaScript encarregades d'interceptar l'esdeveniment `submit` dels formularis clau per controlar que les dades compleixin els requisits de l'aplicació:

### A. Validació en Creació d'Incidències (`comprobarCrearIncidencia()`)
- **Control de desplegables:** Comprova que l'usuari hagi seleccionat obligatòriament un valor vàlid per als camps `departament` i `tipo` (Software, Hardware, Internet, Corrent).
- **Mínim de text en la descripció:** S'assegura que el camp de text de la incidència contingui una explicació real del problema amb un mínim de 20 caràcters per evitar missatges buits.

### B. Validació de Formularis d'Actuació (`introduirDesc()`)
- **Validació del temps:** Controla que el camp `duracio` contingui un valor numèric sencer positiu superior a 0 (minuts reals que el tècnic ha invertit).
- **Camps i Checkboxes:** Es valida l'estat dels paràmetres de control (com el camp `visible`) abans de permetre l'actualització de l'històric de l'actuació.

### C. Gestió d'Edició d'Incidències (`errorUpdateIncidencia()`)
- S'activa en els modals de modificació per a l'administrador, verificant que camps crítics com la `prioritat` (Alta, Mitja, Baixa) o el `tecnic` assignat no s'enviïn buits, controlant el cicle de vida del tiquet.