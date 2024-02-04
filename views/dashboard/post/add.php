<section id="main__pic">
        <div id="overlay">
            <h2 class="text-center text-white">DASHBOARD <br>Ajouter un article</h2>
        </div>
</section>

<section class="container ">
    <div class="m-5 py-3">
        <form method="POST" class="row">
            <div class="col-12 col-lg-4 p-2">
                <label for="articleDate" class="form-label">Date de création</label>
                <input type="date" name="articleDate" value="" class="form-control" id="articleDate" aria-describedby="articleDateHelp">
                <span class="text-danger"></span>
            </div>

            <div class="col-12 col-lg-4 p-2">
                <label for="articleCategory" class="form-label">Catégorie</label>
                <select type="text" name="articleCategory" value="" class="form-select" id="articleCategory" aria-label="Default select example">
                    <option selected disabled>--Sélectionnez la catégorie--</option>
                    <option value="">Emploi </option>
                    <option value="">Se loger</option>
                    <option value="">Vie amiénoise</option>
                </select>
                <span class="text-danger"></span>
            </div>
            
            <div class="col-12 col-lg-4 p-2">
                <label for="authorName" class="form-label">Nom d'auteur</label>
                <input type="text" name="authorName" value="" class="form-control" id="authorName" aria-describedby="nameHelp" minlength="2" maxlength="50" pattern="^[a-zA-Zàáčćèéëėìíîï '\-]{2,50}$">
                <span class="text-danger"></span>
            </div>
                        
            <div class="col-12 col-lg-6 p-2">
                <label for="articleTitle" class="form-label">Titre</label>
                <input type="text" name="articleTitle" value="" class="form-control" id="articleTitle" aria-describedby="nameHelp" minlength="2" maxlength="50" pattern="^[a-zA-Zàáčćèéëėìíîï '\-]{2,50}$">
                <span class="text-danger"></span>
            </div>

            <div class="col-12 col-lg-6 p-2">
                <label for="date" class="form-label">Ajouter une image</label>
                <input type="file" name="authorName" value="" class="form-control" id="authorName" aria-describedby="nameHelp" minlength="2" maxlength="50" pattern="^[a-zA-Zàáčćèéëėìíîï '\-]{2,50}$">
                <span class="text-danger"></span>
            </div>
                        
            <div class="col-12 p-2">
                <label for="date" class="form-label">Description</label>
                <textarea type="text" row="10" name="authorName" value="" class="form-control" id="authorName" aria-describedby="nameHelp"></textarea>
                <span class="text-danger"></span>
            </div>

            <div class="text-center mt-2">
                <button type="submit" class="btn btn-primary text-white text-uppercase" id="btn-send-contact" value="Envoyer">Envoyer</button>
            </div>

        </form>
    </div>
</section>
    