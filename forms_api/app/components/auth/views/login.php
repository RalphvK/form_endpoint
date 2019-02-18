            <!-- errors -->
            <div id="errors" style="position: absolute; width: 100%;">
            </div>

            <section class="edit-meta" style="max-width: 400px; padding-top: 20vh; margin: 0 auto;">
                <!-- login form -->
                <form class="card" action="javascript:;" onsubmit="submitLoginForm(event);">
                    <div class="form-group input-material">
                        <input type="text" class="form-control" id="email-field" name="email" required>
                        <label for="email-field">Email</label>
                    </div>
                    <div class="form-group input-material">
                        <input type="password" class="form-control" id="password-field" name="password" required>
                        <label for="password-field">Password</label>
                    </div>
                    <button type="submit" class="btn btn-primary icon-padding mt-5" style="width: 100%;">
                        <i class="icon ion-ios-unlock icon-md"></i>
                        Login
                    </button>
                </form>
            </section>