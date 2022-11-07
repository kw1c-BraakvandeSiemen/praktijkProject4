/*

  Auteur: Siemen van de Braak
  Aanmaakdatum: 02-06-2022
  Omschrijving: Navbar js

*/

//variabele aanmaken die de menu list id ziet als variabele
var menuList = document.getElementById("menuList")

//de standaard hoogte zetten op 0 pixels
menuList.style.maxHeight = "0px";


//function aanmaaken voor de hamburgermenu
function togglemenu()
{
    //als de menu 0px is wat hij standaar is dan word deze 200px groot
    if(menuList.style.maxHeight == "0px")
    {
        menuList.style.maxHeight = "200px"
    }
    //als hij dus al groter is dan 0 gaat hij weer terug naar 0
    else
    {
        menuList.style.maxHeight = "0px"
    }
}