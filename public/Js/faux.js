// Calcul debit
function calculateTotalDebitWithSearch() {
  const table = $('#myTable').DataTable();
  const searchValue = table.search(); // Obtenez la valeur de recherche
  
  let totalDebit = 0;
  
  // Parcourez les données filtrées pour calculer le total des débits
  table.rows({ search: 'applied' }).every(function (rowIdx) {
      const debitValue = parseFloat(this.cell(rowIdx, 4).data()) || 0; // Colonne 9 est "Débit"
      totalDebit += debitValue;
  });
  
  return totalDebit;
}

// Événement pour déclencher le calcul du total des débits lors de la recherche
$('#myTable').on('search.dt', function () {
  const totalDebitWithSearch = calculateTotalDebitWithSearch();
  const formattedTotalDebitWithSearch = totalDebitWithSearch.toLocaleString('fr-FR');
  
  // Mettez à jour la balise <p> avec le résultat du calcul
  $('#totalDebit1').text("Total des débits : " + formattedTotalDebitWithSearch);
});









// $(document).ready(function () {
//   const table = $('#myTable').DataTable();
  
//   // Événement pour filtrer quand EC_Lettrage est vide
//   $('#btnFiltrerVide').click(function () {
//       table.column(6).search('^$', true, false).draw();
//   });
  
//   // Événement pour filtrer quand EC_Lettrage n'est pas vide
//   $('#btnFiltrerNonVide').click(function () {
//       table.column(6).search('.+', true, false).draw();
//   });
// });






//Calcul credit
function calculateTotalCreditWithSearch() {
  const table = $('#myTable').DataTable();
  const searchValue = table.search(); // Obtenez la valeur de recherche

  let totalCredit = 0;

  // Parcourez les données filtrées pour calculer le total du crédit
  table.rows({ search: 'applied' }).every(function (rowIdx) {
    const creditValue = parseFloat(this.cell(rowIdx, 6).data()) || 0; 
    totalCredit += creditValue;
  });

  return totalCredit;
}

$('#myTable').on('search.dt', function () {
  const totalCreditWithSearch = calculateTotalCreditWithSearch();
  const formattedTotalCreditWithSearch = totalCreditWithSearch.toLocaleString('fr-FR');

  // Mettez à jour la balise <p> avec le résultat du calcul du crédit
  $('#totalCredit').text("  Total des crédits : " + formattedTotalCreditWithSearch);
});







$(document).ready(function () {
  const table = $('#myTable').DataTable();

  // Événement pour effacer le filtre et réafficher le tableau à l'état initial
  $('#btnEffacerFiltre').click(function () {
    // Effacez le filtre sur la colonne "EC_Lettrage" (colonne 12)
    table.column(6).search('').draw();

    // Réinitialisez la recherche dans DataTables
    table.search('').draw();

    // Réinitialisez le bouton de recherche (si nécessaire)
    // Vous pouvez également ajouter du code pour réinitialiser d'autres éléments de filtrage ici

    // Réaffichez le tableau à son état initial
    table.page(0).draw('page');
  });
});




$(document).ready(function () {
  const table = $('#myTable').DataTable();
  
  // Fonction pour calculer la différence entre débit et crédit
  function calculateBalance() {
    const totalDebit = calculateTotalDebitWithSearch();
    const totalCredit = calculateTotalCreditWithSearch();
    const balance = totalDebit - totalCredit;
    return balance;
  }
  
  // Fonction pour afficher le solde créditeur ou débiteur
  function displayBalanceStatus() {
    const balance = calculateBalance();
    const balanceElement = $('#balanceStatus');
    
    if (balance > 0) {
      balanceElement.text("Le Solde est Créditeur de : " + balance.toLocaleString('fr-FR'));
      balanceElement.removeClass('text-danger').addClass('text-success');
    } else if (balance < 0) {
      balanceElement.text("Le Solde est Débiteur de : " + (-balance).toLocaleString('fr-FR'));
      balanceElement.removeClass('text-success').addClass('text-success');
    } else {
      balanceElement.text("Solde à Zéro");
      balanceElement.removeClass('text-success text-danger');
    } 
  }
  
  // Événement pour recalculer le solde lorsque la recherche change
  $('#myTable').on('search.dt', function () {
    displayBalanceStatus();
  });
  
  // Initialisation du solde
  displayBalanceStatus();
});
