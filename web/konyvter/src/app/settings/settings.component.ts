import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators  } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from '../shared/auth.service';

@Component({
  selector: 'app-settings',
  templateUrl: './settings.component.html',
  styleUrls: ['./settings.component.css']
})
export class SettingsComponent implements OnInit {

  updateuserForm!:FormGroup;
  clicked = false;
  userData:any;

  host = 'http://localhost:8000/api/';

  constructor(
    private router: Router,
    private http: HttpClient,
    private auth: AuthService
  ) { }

  ngOnInit(): void {
    this.getUserData();
    this.updateuserForm = new FormGroup({
      mail: new FormControl('', [Validators.required, Validators.email,  Validators.maxLength(255)]),
      user: new FormControl('', [Validators.required, Validators.pattern('[a-zéáíűőúöüóA-ZÉÁÍSŰŐÚÖÜÓ0-9]+'), Validators.minLength(4), Validators.maxLength(50)]),
      pass: new FormControl('', [Validators.required, Validators.minLength(5), Validators.maxLength(50)]),
      pass2: new FormControl('', [Validators.required, Validators.minLength(5), Validators.maxLength(50)]),
      phone: new FormControl('', Validators.pattern('[0-9]{11}'))
    });
  }
  getUserData(){
    let endpoint = 'account';
    let url = this.host + endpoint;

    let token = this.auth.isLoggedIn();

    let headerObj = new HttpHeaders({
      'Content-Type':'application/json',
      'Authorization': `Bearer ${token}`
    })
    let header = {
      headers: headerObj
    }
    this.http.get<any>(url,header)
    .subscribe(
      (res) => {
        this.userData = res.data;
      }, (error) => {
        console.error(error);
    });
  }
  update(){

    let mail = this.updateuserForm.value.mail;
    let user = this.updateuserForm.value.user;
    let pass = this.updateuserForm.value.pass;
    let pass2 = this.updateuserForm.value.pass2;
    let phone = this.updateuserForm.value.phone;

    if(pass != pass2){
      alert("A jelszavak nem egyeznek!")
    }else{
      let endpoint = 'account';
      let url = this.host + endpoint;

      let authData;
      
      if(phone == null){
        authData = {
          email: mail,
          username: user,
          password: pass,
          confirm_password: pass2
        }
      }else{
        authData = {
          email: mail,
          username: user,
          password: pass,
          confirm_password: pass2,
          phone: phone
        }
      }
      let data = JSON.stringify(authData);
  
      let token = this.auth.isLoggedIn();

      let headerObj = new HttpHeaders({
        'Content-Type':'application/json',
        'Authorization': `Bearer ${token}`
      })
  
      let header = {
        headers: headerObj
      }
      this.http.put<any>(url,data,header)
      .subscribe(
        (res) => {
          alert("Adatok sikeresen módosítva!")
          location.reload();
        }, (error) => {
          console.error(error);
          alert("Az adatok módosítása sikertelen!\nValószínüleg a megadott email-cím vagy felhasználónév már benne van a rendszerünkben!");
          location.reload();
      });
    }
  }
  deleteAccount(){
    let endpoint = 'account';
    let url = this.host + endpoint;

    let token = this.auth.isLoggedIn();

    let headerObj = new HttpHeaders({
      'Content-Type':'application/json',
      'Authorization': `Bearer ${token}`
    })
    let header = {
      headers: headerObj
    }
    this.http.delete<any>(url,header)
    .subscribe(
      (res) => {
        alert('A fiók és a hozzá tartozó adatok törölve!');
        this.auth.logout();
        this.router.navigate(['']);
      }, (error) => {
        console.error(error);
    });
  }
}
