import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Validators, FormControl, FormGroup} from '@angular/forms';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AuthService } from '../shared/auth.service';
@Component({
  selector: 'app-myadvertisements',
  templateUrl: './myadvertisements.component.html',
  styleUrls: ['./myadvertisements.component.css']
})
export class MyadvertisementsComponent implements OnInit {

  myads:any;

  host = 'http://localhost:8000/api/';
  server = 'http://localhost:8000';

  constructor(
    private router: Router,
    private http: HttpClient,
    private auth: AuthService
  ) { }

  ngOnInit(): void {
    this.getMyAds();
  }
  getMyAds(){
    let endpoint = 'web/advertisements/my';
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
        this.myads = res.data;
      }, (error) => {
        console.error(error);
    });
  }
}
