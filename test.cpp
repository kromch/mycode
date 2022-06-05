#include <iostream>       
#include <thread>         
#include <string>
#include <filesystem>
#include <fstream>

static int found=0, start=0;
static string initpoint="C:\\";

string tolowerstr(string data)
{
  std::for_each(data.begin(),data.end(),[](char & c) {
  c = std::tolower(c);
  return data;
}
 
void file_scan(string filename) 
{
filename=tolowerstr(filename);
while(1) {
	if !start  {
	start=1;	
    for(auto& p: std::filesystem::recursive_directory_iterator(initpoint)) {
    if(found) return;
    if p.depth()==1 {
	  std::filesystem::recursive_directory_iterator& t=p;
	  initpoint=(t++).path();
	  start=0;
	}
      if p.is_regular_file&&tolowerstr(p.path).find(filename)
	  {
       found=1; 
	   cout << "Found file : " << filename << "\n";
	   cout << "Full file path : " << p.path;
	   string fileout = "Test.b";
       std::ofstream ostrm(fileout, std::ios::out);
       ostrm << "Found file : " << filename << "\n";
	   ostrm << "Full file path : " << p.path;
	   ostrm.close();
	 }
	if !found throw std::overflow_error("Not found file"+filename);	
	}
}
}
int main() 
{
  std::thread threads[8];                         
  try
   {
  for (int i=0; i<8; i++) {
    threads[i] = std::thread(file_scan,"name_file.txt");
    if(threads[i].joinable())
    threads[i].detach(); }
   } catch (exception& e)
     {
       cout << e.what() << '\n';
     }
  
return 0;
}