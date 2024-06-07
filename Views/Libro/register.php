<div class="container mt-5">
    <div class="alert alert-info text-center" role="alert">
        Registro de libro
    </div>
    <form class="">
        <div class="row g-3">
            <div class="col">
                <label for="titulo">Titulo:</label>
                <input type="text" class="form-control" id="titulo" name="titulo">
            </div>
            <div class="col">
                <label for="autor">Autor:</label>
                <input type="text" class="form-control" id="autor" name="autor">
            </div>
            <div class="col">
                <label for="bodega">Bodega:</label>
                <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-info-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                </svg>
            </div>
        </div>

        <div class="row g-3">
            <div class="col">
                <label for="origen">Origen:</label>
                <input type="text" class="form-control" id="origen" name="origen">
            </div>
            <div class="col">
                <label for="estado">estado:</label>
                <select class="form-select" name="estado" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col">
              <label for="imprenta">Imprenta</label>
                <input type="text" class="form-control" id="imprenta" name="imprenta">
            </div>
        <!-- <div class="col-auto">
            <label for="inputPassword2" class="visually-hidden">Password</label>
            <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
        </div> -->
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Confirm identity</button>
        </div>
    </form>
</div>
