<section class="section-modal" id="filter-modal">
    <div class="box-modal">
        <form id="filter-form" class="form-modal" method="POST">
            @csrf
            <input type="hidden" id="table" name="table">
            <label for="date" class="label-text">Fecha:</label>
            <input type="text" name="date" class="input-text dateFilter" placeholder="Selecciona una fecha">

            <div class="space-10"></div>

            <div class="button-box">
                <input type="submit" value="Aplicar" class="buttons button-lightBlue">
                <input type="button" value="Cancelar" class="buttons button-red" id="button-cancel">
            </div>
            
        </form>
    </div>
</section>