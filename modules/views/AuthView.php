<?php
class AuthView {
    protected $user;

    public function __construct($user = null) {
        if ($user != null) {
            $this->user = $user;
        }
    }

    public function showLoginForm() {
        ob_start()
        ?>

        <form id="loginForm" class="loginRegisterForm max-w-96 mx-auto card shadow-lg p-6 bg-base-200" action="/login" method="POST">
            <h2 class="text-2xl font-bold mb-4 text-center">Se connecter</h2>

            <div id="messageContainer" class=""></div>

            <div class="form-control mb-4">
                <label for="email" class="label">
                    <span class="label-text">Email :</span>
                </label>
                <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        class="input input-bordered w-full"
                />
            </div>

            <div class="form-control mb-4">
                <label for="password" class="label">
                    <span class="label-text">Mot de passe :</span>
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="input input-bordered w-full"
                />
            </div>
            <div>
                <input type="checkbox" id="remember" name="remember"/>
                <label for="remember">Se souvenir de moi</label>
            </div>

            <button type="submit" class="btn btn-primary w-full mt-4">Connexion</button>

            <a href="/register" class="link link-primary mt-2 block text-center">
                Pas de compte ? S'enregistrer
            </a>
        </form>


        <?php
        return ob_get_clean();

    }

    public function showRegisterForm() {
        ob_start()
        ?>
        <form id="registerForm" class="loginRegisterForm max-w-96 mx-auto card shadow-lg p-6 bg-base-200" action="/register" method="POST">
            <h2 class="text-2xl font-bold mb-4 text-center">S'inscrire</h2>

            <!-- Conteneur pour les messages -->
            <div id="messageContainer" class=""></div>

            <!-- Champ nom d'utilisateur -->
            <div class="form-control mb-4">
                <label for="name" class="label">
                    <span class="label-text">Nom d'utilisateur :</span>
                </label>
                <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        autocomplete="username"
                        class="input input-bordered w-full"
                />
            </div>

            <!-- Champ email -->
            <div class="form-control mb-4">
                <label for="email" class="label">
                    <span class="label-text">Email :</span>
                </label>
                <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        autocomplete="email"
                        class="input input-bordered w-full"
                />
            </div>

            <!-- Champ mot de passe -->
            <div class="form-control mb-4">
                <label for="password" class="label">
                    <span class="label-text">Mot de passe :</span>
                </label>
                <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        class="input input-bordered w-full"
                />
            </div>

            <!-- Bouton d'inscription -->
            <button type="submit" class="btn btn-primary w-full mt-4">Inscription</button>

            <a href="/login" class="link link-primary mt-2 block text-center">
                Déjà un compte ? Se connecter
            </a>
        </form>

        <?php
        return ob_get_clean();

    }
}
