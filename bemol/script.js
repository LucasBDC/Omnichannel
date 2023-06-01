const cepInput = document.getElementById("cep");
const ruaInput = document.getElementById("rua");
const bairroInput = document.getElementById("bairro");
const estadoInput = document.getElementById("estado");
const cidadeInput = document.getElementById("cidade");

cepInput.addEventListener("blur", function() {
  const cep = cepInput.value.replace(/\D/g, ""); // Remove non-digits from CEP

  if (cep.length === 8) {
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
      .then(response => response.json())
      .then(data => {
        if (!data.erro) {
          ruaInput.value = data.logradouro;
          bairroInput.value = data.bairro;
          estadoInput.value = data.uf;
          cidadeInput.value = data.localidade;
        } else {
          clearAddressFields();
          console.error("CEP not found.");
        }
      })
      .catch(error => {
        clearAddressFields();
        console.error("Error:", error);
      });
  } else {
    clearAddressFields();
    console.error("Invalid CEP.");
  }
});

function clearAddressFields() {
  ruaInput.value = "";
  bairroInput.value = "";
  estadoInput.value = "";
  cidadeInput.value = "";
}
