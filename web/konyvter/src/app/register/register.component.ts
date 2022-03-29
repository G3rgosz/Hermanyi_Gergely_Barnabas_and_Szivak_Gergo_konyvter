import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators  } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from '../shared/auth.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {

  registerForm!:FormGroup;
  clicked = false;

  constructor(
    private auth: AuthService,
    private router: Router
  ) { }

  ngOnInit(): void {
    this.registerForm = new FormGroup({
      mail: new FormControl('', [Validators.required, Validators.email,  Validators.maxLength(255)]),
      user: new FormControl('', [Validators.required, Validators.pattern('[a-zéáíűőúöüóA-ZÉÁÍSŰŐÚÖÜÓ0-9]+'), Validators.minLength(4), Validators.maxLength(50)]),
      pass: new FormControl('', [Validators.required, Validators.minLength(5), Validators.maxLength(50)]),
      pass2: new FormControl('', [Validators.required, Validators.minLength(5), Validators.maxLength(50)]),
      phone: new FormControl('', Validators.pattern('[0-9]{11}'))
    });
  }
  register(){
    let mail = this.registerForm.value.mail;
    let user = this.registerForm.value.user;
    let pass = this.registerForm.value.pass;
    let pass2 = this.registerForm.value.pass2;
    let phone = this.registerForm.value.phone;

    this.auth.register(mail, user, pass, pass2, phone)
    .subscribe(
      (res) => {
        alert("Sikeres regisztráció!");
        this.router.navigate(['']);
      }, (error) => {
        console.error(error);
        alert("A regisztráció sikertelen!\nEllenőrizze, hogy a jelszavak egyeznek-e?\nValamint lehetséges, hogy a felhasználónév vagy e-mail cím már regisztrálva van, ez esetben próbáljon meg másik e-mail címet és felhasználó nevet!");
      })
  }
}