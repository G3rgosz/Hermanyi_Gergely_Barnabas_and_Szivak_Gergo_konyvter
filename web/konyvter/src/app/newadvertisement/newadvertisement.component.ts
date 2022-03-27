import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Validators, FormControl, FormGroup} from '@angular/forms';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AuthService } from '../shared/auth.service';

@Component({
  selector: 'app-newadvertisement',
  templateUrl: './newadvertisement.component.html',
  styleUrls: ['./newadvertisement.component.css']
})
export class NewadvertisementComponent implements OnInit {

  clicked = false;
  genres:any;
  newadForm!: FormGroup;
  genreList: string[] =[];
  file!:File;
  bookid!:number;

  host = 'http://localhost:8000/api/';

  constructor(
    private router: Router,
    private http: HttpClient,
    private auth: AuthService
  ) { 
  }

  ngOnInit(): void {
    this.getGenres()
    .subscribe(
      (res) => {
        this.genres = res.data;
      }, (error) => {
        console.error(error);
    });
    this.newadForm = new FormGroup({
      title: new FormControl('', [Validators.required,  Validators.maxLength(100)]),
      writer: new FormControl('', [Validators.required,  Validators.maxLength(255)]),
      publisher: new FormControl('', Validators.maxLength(255)),
      release: new FormControl('', [Validators.required, Validators.pattern("[-0-9]*$"), Validators.maxLength(5), Validators.min(-5000), Validators.max(2022)]),
      language: new FormControl('', Validators.maxLength(50)),
      genres: new FormControl(''),
      adtitle: new FormControl('', [Validators.required,  Validators.maxLength(50)]),
      price: new FormControl('', [Validators.required,  Validators.maxLength(11), Validators.pattern("[0-9]*$")]),
      image: new FormControl('', Validators.required),
      description: new FormControl('', [Validators.required,  Validators.minLength(20)])
    });
  }
  newAdvertisement(){
    if(this.genreList.length == 0){
      alert("Válasszon ki legalább egy műfajt!")
    }else{
      this.newBook()
      .subscribe(
        (res) => {
          this.newAd(res.data)
          .subscribe(
            (res) => {
              alert("Hirdetés sikeresen felvéve!");
              this.router.navigate(['']);
            }, (error) => {
              console.error(error);
            })
        }, (error) => {
          console.error(error);
        });
    }
  }
  checkboxController(genre:string){
    if(this.genreList.includes(genre)){
      let index = this.genreList.indexOf(genre);
      this.genreList.splice(index, 1);
    }else{
      this.genreList.push(genre);
    }
  }
  handleFileInput(event: any) {
    this.file = event.target.files[0];
  }
  getGenres(){
    let endpoint = 'web/genres';
    let url = this.host + endpoint;
    return this.http.get<any>(url);
  }
  newBook(){
    let endpoint = 'web/books';
    let url = this.host + endpoint;

    let bookData = {
      title: this.newadForm.value.title,
      writer: this.newadForm.value.writer,
      publisher: this.newadForm.value.publisher,
      release: this.newadForm.value.release,
      language: this.newadForm.value.language,
      genres: this.genreList
    }
    let token = this.auth.isLoggedIn();

    let data = JSON.stringify(bookData);
    let headerObj = new HttpHeaders({
      'Content-Type':'application/json',
      'Authorization': `Bearer ${token}`
    })
    let header = {
      headers: headerObj
    }
    return this.http.post<any>(url,data,header);
  }
  newAd(data:any){
    let endpoint = 'web/advertisements';
    let url = this.host + endpoint;
    const formData = new FormData();

    formData.append('adtitle', this.newadForm.value.adtitle);
    formData.append("price", this.newadForm.value.price);
    formData.append("description", this.newadForm.value.description);
    formData.append("book_id", data);
    formData.append("image", this.file); 

    let token = this.auth.isLoggedIn();

    let headerObj = new HttpHeaders({
      'Authorization': `Bearer ${token}`
    })
    let header = {
      headers: headerObj
    }
    return this.http.post<any>(url,formData,header);
  }
}
