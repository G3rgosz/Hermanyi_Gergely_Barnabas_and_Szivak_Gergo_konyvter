import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Validators, FormControl, FormGroup} from '@angular/forms';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AuthService } from '../shared/auth.service';

@Component({
  selector: 'app-updateadvertisement',
  templateUrl: './updateadvertisement.component.html',
  styleUrls: ['./updateadvertisement.component.css']
})
export class UpdateadvertisementComponent implements OnInit {

  clicked = false;
  genres:any;
  updateadForm!: FormGroup;
  genreList: string[] =[];
  file!:File;
  bookid!:number;
  id:any;
  ad:any = [];
  bookArray:any = [];

  host = 'http://localhost:8000/api/';
  server = 'http://localhost:8000';

  constructor(
    private router: Router,
    private http: HttpClient,
    private auth: AuthService,
    private route: ActivatedRoute
  ) { 
  }

  ngOnInit(): void {
    this.id = this.route.snapshot.paramMap.get('id');
    this.getGenres()
    .subscribe(
      (res) => {
        this.genres = res.data;
      }, (error) => {
        console.error(error);
    });
    this.getAdData();
    this.updateadForm = new FormGroup({
      title: new FormControl('', [Validators.required,  Validators.maxLength(100)]),
      writer: new FormControl('', [Validators.required,  Validators.maxLength(255)]),
      publisher: new FormControl('', Validators.maxLength(255)),
      release: new FormControl('', [Validators.required, Validators.pattern("[-0-9]*$"), Validators.maxLength(5), Validators.min(-5000), Validators.max(2022)]),
      language: new FormControl('', Validators.maxLength(50)),
      genres: new FormControl(''),
      adtitle: new FormControl('', [Validators.required,  Validators.maxLength(49)]),
      price: new FormControl('', [Validators.required,  Validators.maxLength(10), Validators.pattern("[0-9]*$")]),
      image: new FormControl('', Validators.required),
      description: new FormControl('', [Validators.required,  Validators.minLength(20)])
    });
    // this.updateadForm.patchValue({
    //   title: this.bookArray.title,
    // });
  }
  checkboxController(genre:string){
    if(this.genreList.includes(genre)){
      let index = this.genreList.indexOf(genre);
      this.genreList.splice(index, 1);
    }else{
      this.genreList.push(genre);
    }
  }
  checker(genre:any){
    for(let oldgenre of this.bookArray[0].genres){
      if(oldgenre == genre){
        return true;
      }
    }
    return false;
  }
  handleFileInput(event:any) {
    this.file = event.target.files[0];
  }
  getGenres(){
    let endpoint = 'web/genres';
    let url = this.host + endpoint;
    return this.http.get<any>(url);
  }
  downloadFile(){
    let url = this.server + this.ad.picturepath; 
  }
  getAdData(){
    let endpoint = 'web/advertisements/';
    let url = this.host + endpoint + this.id;
    this.http.get<any>(url)
    .subscribe(
      (res) => {
        this.ad = res.data;
        this.getBookData();
        this.downloadFile();
      }, (error) => {
        console.error(error);
    });
  }
  getBookData(){
    let endpoint = 'web/books/';
    let url = this.host + endpoint + this.ad.book_id;
    this.http.get<any>(url)
    .subscribe(
      (res) => {
        this.bookArray = res.data;
      }, (error) => {
        console.error(error);
    });
  }
  updateAdvertisement(){}
}
