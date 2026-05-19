# 🎨 Disseny Interfície Web, Usabilitat i Accessibilitat

L'apartat visual de l'aplicació s'ha dissenyat des de zero utilitzant el framework **Bootstrap 5**, prioritzant un disseny net, intuïtiu i totalment adaptat a entorns de gestió educativa.

## 👁️ 1. Avaluació Heurística Aplicada

L'entorn s'ha construït seguint els principis clau de la usabilitat:
1. **Visibilitat de l'estat:** El sistema utilitza *Badges* (etiquetes) de colors per indicar l'estat de les operacions o mètodes de xarxa (Verd per a mètodes `GET`, Groc/Taronja per a mètodes `POST` i Vermell per a errors o eliminacions `DELETE`).
2. **Consistència i estàndards:** S'ha definit una capçalera comuna (`header.php`) que manté la barra de navegació idèntica a totes les seccions del web. El logotip del centre sempre actua com a botó de retorn a la pàgina principal.
3. **Prevenció d'errors:** Els botons crítics com *"Netejar Filtres"* o *"Cancel·lar"* utilitzen tons neutres (`btn-light`, `text-muted`) per evitar clics accidentals de l'usuari.

---

## 🎨 2. Paleta de Colors i Disseny de Components (UI)

S'ha escollit una identitat visual corporativa basada en el contrast:
- **Color Primari (`#185FA5`):** Un blau institucional utilitzat per a les capçaleres de les taules de logs, els botons d'acció principals (*Filtrar*) i el cos de les targetes analítiques superiors.
- **Targetes d'Indicadors (Cards):** S'han col·locat 4 indicadors superiors amb ombres suaus (`shadow-sm`) i icones vectorials de **Bootstrap Icons** (com `bi-bar-chart-fill` o `bi-person-check`) per mostrar de forma immediata el resum del sistema.

---

## 📱 3. Disseny Responsive & Accessibilitat (UX)

- **Grid de Bootstrap:** S'ha fet ús de les classes de reixeta adaptativa (`col-12 col-md-3 col-lg-8`). Les taules i gràfiques es mostren en columnes en pantalles grans (ordinadors d'escola) i es apilen verticalment en dispositius mòbils (telèfons dels tècnics mentre reparen una aula).
- **Taules amb Scroll:** S'ha embolicat la taula de logs dins de la classe `.table-responsive` per evitar que el disseny trenqui la pantalla en pantalles petites, afegint una barra de desplaçament horitzontal interna.