{extends file="public/templates/default-layout.html"}

{block name="css"}
<style>
    /* td {
        background: #eeeeee;
    } */
</style>
{/block}

{block name="title"}Mi Perfil{/block}

{block name="main-header"}
    <h1 class="text-center mt-2 mb-4">Mi Perfil</h1>
{/block}

{block name="main"}
    <div class="container row">
        <table class="table table-striped col-md-6 m-auto">
            <thead>
                <tr>
                    <th colspan="2"><h3 class="text-center">Mis Datos</h3></th>
                </tr>
            </thead>
            <tr>
                <th>ID:</th>
                <td>{$myUser.id}</td>
            </tr>
            <tr>
                <th>Username:</th>
                <td>{$myUser.username}</td>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td>{$myUser.nombre}</td>
            </tr>
            <tr>
                <th>Apellidos:</th>
                <td>{$myUser.apellidos}</td>
            </tr>
            <tr>
                <th>Status:</th>
                <td>{$myUser.status}</td>
            </tr>
            <tr>
                <th>Rol:</th>
                <td>{$myUser.rol}</td>
            </tr>
            <tr>
                <th>Fecha de creación:</th>
                <td>{$myUser.created_at}</td>
            </tr>
        </table>

        <form class="col-md-6 pt-2" action="./mi-perfil/change-pass" method="post">
            {if !empty($response)}
                <div class="alert alert-{if !empty($response.error)}danger{else}success{/if} alert-dismissible fade show" role="alert">
                    {if !empty($response.error)}<strong>Error!</strong> {/if}{$response.msg}
                    <button class="close" data-dismiss="alert" aria-label="Close" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            {/if}

            <label for="pass">Contraseña</label>
            <input class="form-control" type="password" name="pass" placeholder="* * * * * *" maxlength="25" required>

            <label for="pass1">Nueva contraseña</label>
            <input class="form-control" type="password" name="pass1" placeholder="* * * * * *" minlength="6" maxlength="25" required>

            <label for="pass2">Repetir nueva contraseña</label>
            <input class="form-control" type="password" name="pass2" placeholder="* * * * * *" minlength="6" maxlength="25" required>

            <button class="btn btn-primary mt-4" type="submit" title="Cambiar contraseña">Actualizar</button>
        </form>
    </div>
{/block}