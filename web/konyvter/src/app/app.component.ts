import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from '../app/shared/auth.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})

export class AppComponent implements OnInit {
  title = 'konyvter';

  loginForm !: FormGroup;

  constructor(
    private auth: AuthService,
    private formBuilder: FormBuilder,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
      user: [''],
      pass: ['']
    });
  }

  login() {
    let user = this.loginForm.value.user;
    let pass = this.loginForm.value.pass;

    this.auth.login(user, pass)
    .subscribe(
      (res) => {
        localStorage.setItem('currentUser', 
        JSON.stringify({token: res.data.token, name: res.data.name})
        );
        this.refresh();
      }, (error) => {
        console.error('error caught in component');
        this.refresh();
        alert("A belépés sikertelen!");
      })
  }
  regpage(){
    this.router.navigate(['register']);
  }
  isLoggedIn() {
    return this.auth.isLoggedIn()
  }
  logout(){
    this.auth.logout();
  }
  refresh(): void {
    window.location.reload();
}
}

