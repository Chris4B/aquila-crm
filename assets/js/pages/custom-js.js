
// import $ from 'jquery';

// $(function() {
//     var locationIndex = $('#localisationContainer .row.mb-3').length; // Comptez les ensembles existants pour continuer avec des index uniques

//     $('#addLocationBtn').on('click', function() {
//         var locationIndex = $('.address-block').length; // Comptez les blocs pour l'indexation
//         var newLocationHtml = `
//             <div class="address-block mt-3">
//                 <h5 class="title mb-3"> NOUVELLE ADRESSE</h5>
//                 <div class="row mb-3">
//                     <label class="col-md-3 col-form-label" for="addressType-${locationIndex}"> Type d'adresse</label>
//                     <div class="col-md-9">
//                         <input type="text" class="form-control" id="addressType${locationIndex}" name="addressType[]" placeholder="De quel type d'adresse s'agit il ?" >
//                     </div> 
//                 </div>
//                 <div class="row mb-3">
//                     <label class="col-md-3 col-form-label" for="streetNumber-${locationIndex}">N° de voie</label>
//                     <div class="col-md-9">
//                         <input type="text" class="form-control" id="streetNumber-${locationIndex}" name="streetNumber[]" placeholder="Entrez un numéro de voie">
//                     </div>
//                 </div>
//                 <div class="row mb-3">
//                     <label class="col-md-3 col-form-label" for="streetName-${locationIndex}">Nom de la rue</label>
//                     <div class="col-md-9">
//                         <input type="text" class="form-control" id="streetName-${locationIndex}" name="streetName[]" placeholder="Entrez un nom de rue">
//                     </div>
//                 </div>
//                 <div class="row mb-3">
//                     <label class="col-md-3 col-form-label" for="town-${locationIndex}">Ville</label>
//                     <div class="col-md-9">
//                         <input type="text" class="form-control" id="town-${locationIndex}" name="town[]" placeholder="Entrez une ville">
//                     </div>
//                 </div>
//                 <div class="row mb-3">
//                     <label class="col-md-3 col-form-label" for="zipCode-${locationIndex}">Code Postal</label>
//                     <div class="col-md-9">
//                         <input type="text" class="form-control" id="zipCode-${locationIndex}" name="zipCode[]" placeholder="Entrez un code postal">
//                     </div>
//                 </div>
                
//             </div> <!-- address-block end -->
//         `;
    
//         $('#localisationContainer').append(newLocationHtml);
//         updateRemoveButtonVisibility();

//         // Incrémenter l'index pour le prochain ajout
//         locationIndex++;
//     });
    
    // $('#removeLocationBtn').on('click', function() {
    //     $('.address-block').last().remove(); // Supprime le dernier bloc ajouté
    //     updateRemoveButtonVisibility();
    // });

    // function updateRemoveButtonVisibility() {
    //     if ($('.address-block').length > 0) {
    //         $('#removeLocationBtn').show(); // Montre le bouton si au moins un bloc existe
    //     } else {
    //         $('#removeLocationBtn').hide(); // Cache le bouton si aucun bloc n'existe
    //     }
    // }
// });

// embed collections forms

// // $(function() {
// //     // Assurez-vous d'utiliser $ devant le nom de variable pour indiquer que c'est un objet jQuery
// //     var $localisationContainer = $('#localisationContainer'); // Utilisez $ pour indiquer les éléments jQuery
// //     var $addLocationBtn = $('#addLocationBtn'); // Correction du nom de variable pour une cohérence avec le jQuery selector

// //     // Handler pour ajouter un nouveau bloc d'adresse
// //     $addLocationBtn.on('click', function() {
// //         var index = $localisationContainer.children('.address-block').length; // Assurez-vous d'utiliser la variable correctement définie avec $
// //         var newForm = $localisationContainer.data('prototype').replaceAll(/__name__/g, index); // Utilisez replace si vous remplacez une seule instance, sinon replaceAll est correct

// //         var $newFormHtml = $('<div class="address-block"></div>').append(newForm);
// //         $newFormHtml.append('<button type="button" class="remove-address btn btn-danger">Supprimer cette adresse</button>');
        
// //         // Ajoute le nouveau bloc au conteneur
// //         $localisationContainer.append($newFormHtml);
// //     });

// //     // Gestionnaire d'événement pour supprimer une adresse spécifique
// //     $localisationContainer.on('click', '.remove-address', function() {
// //         $(this).closest('.address-block').remove();
// //     });
// });

    
// close dlash messages after 10 seconds


// setTimeout(function(){
//     let flashMessage = document.getElementById('flash-message');
//     console.log(flashMessage);
//     if(flashMessage){
//         flashMessage.classList.add('hide');
//         setTimeout(function(){
//             flashMessage.remove();
//         }, 500); 
//     }
// }, 10000);


// Dynamic serach bar 
// document.addEventListener('DOMContentLoaded', function() {
//     const searchInput = document.querySelector('#top-search');

//     // Ajout d'un écouteur d'événement sur l'input de recherche
//     searchInput.addEventListener('input', function(e) {
//         // Récupération de la valeur saisie dans le champ de recherche
//         const query = e.target.value.trim();

//         // Envoi d'une requête fetch pour récupérer les résultats de recherche
//         fetch(`/search?q=${query}`)
//             .then(response => response.json())
//             .then(data => {
//                 // Sélection de l'élément où les résultats seront affichés
//                 const searchDropdown = document.getElementById('search-dropdown');
                
//                 // Effacement des anciens résultats de recherche
//                 searchDropdown.innerHTML = '';

//                 // Parcours des résultats de recherche et création des éléments correspondants
//                 data.forEach(result => {
//                     const resultItem = document.createElement('a');
//                     resultItem.href = '#'; // Lien vers la page de détails du résultat
//                     resultItem.classList.add('dropdown-item', 'notify-item');
//                     resultItem.innerHTML = `
//                         <i class="uil-notes font-16 me-1"></i>
//                         <span>${result.name}</span>`; // Remplacez result.name par le champ approprié

//                     // Ajout du résultat à la liste des résultats de recherche
//                     searchDropdown.appendChild(resultItem);
//                 });
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//             });
//     });
// });


document.addEventListener('DOMContentLoaded', function() {
    

    const searchForm = document.getElementById('search-form');
    const responsiveSearch = document.getElementById('responsive-search')
    console.log(responsiveSearch);
    const searchInput = document.getElementById('top-search');
    const tableBody = document.querySelector('tbody');

  

    searchInput.addEventListener('input', () => {
        const query = searchInput.value.trim().toLowerCase();
        const rows = tableBody.querySelectorAll('tr');
        let isAnyRowVisible = false;  
        rows.forEach(row => {
            const rowData = row.textContent.trim().toLowerCase();
            if (rowData.includes(query)) {
                row.style.display = "";  
                isAnyRowVisible = true;  
            } else {
                row.style.display = 'none';  
            }
        });
    
        const noMatchMessage = document.getElementById('no-match');  
        if (!isAnyRowVisible) {
            noMatchMessage.style.display = 'block';  
        } else {
            noMatchMessage.style.display = 'none';  
        }
    });
  
})

// document.addEventListener('DOMContentLoaded', function() {
//     const searchInput = document.getElementById('top-search');
//     const responsiveSearchInput = document.getElementById('responsive-search');

//     console.log(responsiveSearchInput)
//     const tableBody = document.querySelector('tbody');
//     const noMatchMessage = document.getElementById('no-match');

//     const filterTableRows = (query) => {
//         const rows = tableBody.querySelectorAll('tr');
//         let isAnyRowVisible = false;
        
//         rows.forEach(row => {
//             const rowData = row.textContent.trim().toLowerCase();
//             if (rowData.includes(query)) {
//                 row.style.display = "";  
//                 isAnyRowVisible = true;  
//             } else {
//                 row.style.display = 'none';  
//             }
//         });

//         if (!isAnyRowVisible) {
//             noMatchMessage.style.display = 'block';  
//         } else {
//             noMatchMessage.style.display = 'none';  
//         }
//     };

//     searchInput.addEventListener('input', () => {
//         const query = searchInput.value.trim().toLowerCase();
//         filterTableRows(query);
//     });

//     responsiveSearchInput.addEventListener('input', () => {
//         const query = responsiveSearchInput.value.trim().toLowerCase();
//         filterTableRows(query);
//     });
// });






