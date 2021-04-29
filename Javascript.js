function addUsr() {
    const regexNum = /^\d+$/;
    const regexMail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const regexExp = /^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/;
    const regexCp = /^\d{5}$|^\d{5}-\d{4}$/;

    var subConfirm = true;

    var nom = document.getElementById("addUsrNom").value;
    var prenom = document.getElementById("addUsrPrenom").value;
    var mdp = document.getElementById("addUsrMdp").value;
    var mail = document.getElementById("addUsrMail").value;
    var telephone = document.getElementById("addUsrPortable").value;
    var cp = document.getElementById("addUsrCp").value;
    var numero = document.getElementById("addUsrNum").value;
    var exp = document.getElementById("addUsrExp").value;

    if(nom == null || nom == "" || prenom == null || prenom == "" || mdp == null || mdp == "") {
        subConfirm = false;
    }

    if(regexMail.test(mail) == false) {
        subConfirm = false;
    }
    
    if(telephone != "" && telephone != null) {
        if(regexNum.test(telephone) == false) {
            subConfirm = false;
        }
    }

    if(cp != "" && cp != null) {
        if(regexCp.test(cp) == false) {
            subConfirm = false;
        }
    }

    if(numero != "" && numero != null) {
        if(regexNum.test(numero) == false) {
            subConfirm = false;
        }
    }

    if(exp != "" && exp != null) {
        if(regexExp.test(exp) == false) {
            subConfirm = false;
        }
    }

    if(subConfirm == false) {
        alert("Veuillez compléter les champs marqués d'une étoile.\nVeuillez aussi vérifier que le numéro de portable, le code postal et le numéro de carte bleue, si remplis, sont uniquement des chiffres.");
        return false;
    } else {
        return true;
    }
}

function modUsr() {
    const regexNum = /^\d+$/;
    const regexMail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const regexExp = /^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/;
    const regexCp = /^\d{5}$|^\d{5}-\d{4}$/;

    var subConfirm = true;

    var nom = document.getElementById("modUsrNom").value;
    var prenom = document.getElementById("modUsrPrenom").value;
    var mdp = document.getElementById("modUsrMdp").value;
    var mail = document.getElementById("modUsrMail").value;
    var telephone = document.getElementById("modUsrPortable").value;
    var cp = document.getElementById("modUsrCp").value;
    var numero = document.getElementById("modUsrNum").value;
    var exp = document.getElementById("modUsrExp").value;

    if(nom == null || nom == "" || prenom == null || prenom == "" || mdp == null || mdp == "") {
        subConfirm = false;
    }

    if(regexMail.test(mail) == false) {
        subConfirm = false;
    }
    
    if(telephone != "" && telephone != null) {
        if(regexNum.test(telephone) == false) {
            subConfirm = false;
        }
    }

    if(cp != "" && cp != null) {
        if(regexCp.test(cp) == false) {
            subConfirm = false;
        }
    }

    if(numero != "" && numero != null) {
        if(regexNum.test(numero) == false) {
            subConfirm = false;
        }
    }

    if(exp != "" && exp != null) {
        if(regexExp.test(exp) == false) {
            subConfirm = false;
        }
    }

    if(subConfirm == false) {
        alert("Veuillez compléter les champs marqués d'une étoile.\nVeuillez aussi vérifier que le numéro de portable, le code postal et le numéro de carte bleue, si remplis, sont uniquement des chiffres.");
        return false;
    } else {
        return true;
    }
}

function addCat() {
    regexSlug = /^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$/;

    var subConfirm = true;

    var titre = document.getElementById("addCatTitre").value;
    var description = document.getElementById("addCatDesc").value;
    var slug = document.getElementById("addCatSlug").value;

    if(titre == null || titre == "" || description == null || description == "") {
        subConfirm = false;
    }

    if(regexSlug.test(slug) == false) {
        subConfirm = false;
    }

    if(subConfirm == false) {
        alert("Veuillez compléter les champs marqués d'une étoile.");
        return false;
    } else {
        return true;
    }
}

function modCat() {
    regexSlug = /^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$/;

    var subConfirm = true;

    var titre = document.getElementById("modCatTitre").value;
    var description = document.getElementById("modCatDesc").value;
    var slug = document.getElementById("modCatSlug").value;

    if(titre == null || titre == "" || description == null || description == "") {
        subConfirm = false;
    }

    if(regexSlug.test(slug) == false) {
        subConfirm = false;
    }

    if(subConfirm == false) {
        alert("Veuillez compléter les champs marqués d'une étoile.");
        return false;
    } else {
        return true;
    }
}

function addProd() {
    regexNum = /^\d+$/;
    regexSlug = /^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$/;

    var subConfirm = true;

    var nom = document.getElementById("addProdNom").value;
    var description = document.getElementById("addProdDesc").value;
    var prix = document.getElementById("addProdPrix").value;
    var quantite = document.getElementById("addProdQuantite").value;
    var slug = document.getElementById("addProdSlug").value;
    var reference = document.getElementById("addProdRef").value;

    if(nom == null || nom == "" || description == null || description == "") {
        subConfirm = false;
    }

    if(regexNum.test(prix) == false) {
        subConfirm = false;
    }

    if(regexNum.test(quantite) == false) {
        subConfirm = false;
    }

    if(regexSlug.test(slug) == false) {
        subConfirm = false;
    }

    if(regexSlug.test(reference) == false) {
        subConfirm = false;
    }

    if(subConfirm == false) {
        alert("Veuillez compléter les champs marqués d'une étoile.\nVeuillez entrer uniquement des chiffres pour le prix et la quantité.");
        return false;
    } else {
        return true;
    }
}

function modProd() {
    regexNum = /^\d+$/;
    regexSlug = /^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$/;

    var subConfirm = true;

    var nom = document.getElementById("modProdNom").value;
    var description = document.getElementById("modProdDesc").value;
    var prix = document.getElementById("modProdPrix").value;
    var quantite = document.getElementById("modProdQuantite").value;
    var slug = document.getElementById("modProdSlug").value;
    var reference = document.getElementById("modProdRef").value;

    if(nom == null || nom == "" || description == null || description == "") {
        subConfirm = false;
    }

    if(regexNum.test(prix) == false) {
        subConfirm = false;
    }

    if(regexNum.test(quantite) == false) {
        subConfirm = false;
    }

    if(regexSlug.test(slug) == false) {
        subConfirm = false;
    }

    if(regexSlug.test(reference) == false) {
        subConfirm = false;
    }

    if(subConfirm == false) {
        alert("Veuillez compléter les champs marqués d'une étoile.\nVeuillez entrer uniquement des chiffres pour le prix et la quantité.");
        return false;
    } else {
        return true;
    }
}

function modCompte() {
    const regexNum = /^\d+$/;
    const regexMail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    var subConfirm = true;

    var nom = document.getElementById("modCompteNom").value;
    var prenom = document.getElementById("modComptePrenom").value;
    var mdp = document.getElementById("modCompteMdp").value;
    var mail = document.getElementById("modCompteMail").value;
    var telephone = document.getElementById("modComptePortable").value;

    if(nom == null || nom == "" || prenom == null || prenom == "" || mdp == null || mdp == "") {
        subConfirm = false;
    }

    if(regexMail.test(mail) == false) {
        subConfirm = false;
    }
    
    if(telephone != "" && telephone != null) {
        if(regexNum.test(telephone) == false) {
            subConfirm = false;
        }
    }

    if(subConfirm == false) {
        alert("Veuillez compléter les champs marqués d'une étoile.\nVeuillez aussi vérifier que le numéro de portable, si rempli, contient uniquement des chiffres.");
        return false;
    } else {
        return true;
    }
}

function modAdresse() {
    const regexCp = /^\d{5}$|^\d{5}-\d{4}$/;

    var subConfirm = true;

    var cp = document.getElementById("modAdresseCp").value;

    if(cp != "" && cp != null) {
        if(regexCp.test(cp) == false) {
            subConfirm = false;
        }
    }

    if(subConfirm == false) {
        alert("Veuillez vérifier que le code postal, si rempli, contient uniquement des chiffres.");
        return false;
    } else {
        return true;
    }
}

function modCarte() {
    const regexNum = /^\d+$/;
    const regexExp = /^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/;

    var subConfirm = true;

    var numero = document.getElementById("modCarteNum").value;
    var exp = document.getElementById("modCarteExp").value;

    if(numero != "" && numero != null) {
        if(regexNum.test(numero) == false) {
            subConfirm = false;
        }
    }

    if(exp != "" && exp != null) {
        if(regexExp.test(exp) == false) {
            subConfirm = false;
        }
    }

    if(subConfirm == false) {
        alert("Veuillez vérifier que le numéro, si rempli, contient uniquement des chiffres.\nVeuillez aussi vérifier que la date d'expiration est sous le format MM/AA.");
        return false;
    } else {
        return true;
    }
}