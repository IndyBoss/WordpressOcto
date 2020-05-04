# Octoform plugin

## Installatie
Download de [Octoform zip](https://github.com/IndyBoss/WordpressOcto/blob/master/wp-content/plugins/octoform.zip) folder en voeg deze toe als plugin aan de Wordpress website.

## Gebruik
Voor elke pagina kan je de volgende shortcode's gebruiken.
Elke pagina moet een paar pagina namen meekrijgen om de links te laten werken.
**De pagina namen moeten exact overeen komen met de namen van de links van de Wordpress Pages waar je deze shortcodes op gaat gebruiken**

**Het eerste gedeelte van de shortcode is enkel de naam van de functie, dit moet niet aangepast worden!**

 * De overzicht pagina waar alle formulieren van die groep getoond worden (Wordpress Page: **overzicht**)
    * _[viewforms add_url="**formulier**" questionaire_url="**vragenlijst**" data_url="**data**"]_
    * add_url: De naam van de pagina zelf om terug te linken na een wijziging.
    * questions_url: De naam van de pagina waar de vragen worden bewerkt.
    * data_url: De formulier resultaten overzicht pagina.


  * De pagina waar de formulieren worden bewerkt (Wordpress Page: **formulier**)
    * _[addform add_url="**formulier**" questions_url="**vraag**" view_url="**overzicht**"]_
    * add_url: De naam van de pagina zelf om terug te linken na een wijziging.
    * questions_url: De naam van de pagina waar de vragen worden bewerkt.
    * view_url: De naam van de overzicht pagina waar alle formulieren van die groep getoond worden.


  * De pagina die je questionaire inzending verifieerd (Wordpress Page: **verstuurd**)
    * _[questionaire_send]_


  * De formulier resultaten overzicht pagina (Wordpress Page: **data**)
    * _[data]_


  * De pagina waar de vragen worden bewerkt (Wordpress Page: **vraag**)
    * _[addquestions add_url="**formulier**" questions_url="**vraag**"]_
    * add_url: De naam van de pagina zelf om terug te linken na een wijziging.
    * questions_url: De naam van de pagina waar de vragen worden bewerkt.


  * De pagina waar je de questionaire kan beantwoorden (Wordpress Page: **vragenlijst**)
    * _[questionaire questionaire_submit_url="**verstuurd**"]_
    * questionaire_submit_url: De pagina die je questionaire inzending verifieerd.
