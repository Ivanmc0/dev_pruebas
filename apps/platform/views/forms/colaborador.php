

<!-- <input class="input" type="hidden" name="id_empresa" value="<?= $_MOD['fath']; ?>" /> -->

<div class="row p0 m0">
    <!--<div class="col-12 col-lg-4 p0 m0 pR5 p0_oS order-3 order-lg-1">
         <div class="pAA10">
            <div class="label">Trato</div>
            <select class="select" name="trato">
                <option>Ninguno</option>
                <option value="Sr.">Sr. - Señor</option>
                <option value="Sra.">Sra. - Señora</option>
                <option value="Srta.">Srta. - Señorita</option>
                <option value="Dir.">Dir. - Director / Directora</option>
                <option value="Dr.">Dr. - Doctor</option>
                <option value="Dra.">Dra. - Doctora</option>
                <option value="Ing.">Ing. - Ingeniero / Ingeniera</option>
                <option value="Lic.">Lic. - Licenciado / Licenciada</option>
                <option value="Arq.">Arq. - Arquitecto / Arquitecta</option>
            </select>
        </div>
    </div>-->
    <!-- <div class="col-12 col-lg-5 p0 m0 order-2 order-lg-2"> </div> -->
    <div class="col-12 col-lg-3 p0 m0 pL5 p0_oS order-1 order-lg-3 mb20_oS">
        <div class="pAA10">
            <div class="label">Estado</div>
            <select class="select" name="inactivo">
                <option value="0">Activo</option>
                <option value="1">Inactivo</option>
            </select>
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-6 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Nombres</div>
            <input class="input" type="text" name="nombres" maxlength='100' />
        </div>
    </div>
    <div class="col-12 col-lg-6 p0 m0 pL5 p0_oS">
        <div class="pAA10">
            <div class="label">Apellidos</div>
            <input class="input" type="text" name="apellidos" maxlength='100' />
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-4 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Tipo</div>
            <select class="select" name="identificacion_tipo">
                <option value="CC">Cédula de ciudadanía</option>
                <option value="CE">Cédula de extranjería</option>
                <option value="PA">Pasaporte</option>
                <option value="TR">Tarjeta de residente</option>
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-8 p0 m0 pL5 p0_oS">
        <div class="pAA10">
            <div class="label">Número de identificación <span class="tag">(solo números)</span></div>
            <input class="input" type="text" name="identificacion" maxlength='100' pattern="[0-9]*"/>
        </div>
    </div>
</div>




<div class="pAA10">
    <div class="label">Email corporativo</div>
    <input class="input" type="text" name="email"  maxlength='100'/>
</div>

<div class="pAA10">
    <div class="label">Teléfono corporativo <span class="tag">(opcional)</span></div>
    <input class="input" type="text" name="telefono" maxlength='50'/>
</div>


<div class="pAA10">
    <div class="label">Celular <span class="tag">(opcional)</span></div>
    <input class="input" type="text" name="celular" maxlength='50'/>
</div>


