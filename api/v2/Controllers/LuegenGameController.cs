using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Newtonsoft.Json;
using Formatting = System.Xml.Formatting;

namespace LuegenGame_Backend.Controllers;

[ApiController]
[Route("v2/[controller]")]
[AllowAnonymous]


public class LuegenGameController : ControllerBase {
    
    private readonly string jsonFilePath = "database/users.json";

    [HttpPost("RegisterUser")]
    public IActionResult RegisterUser([FromQuery] string username, [FromQuery] string password)
    {
        if (string.IsNullOrEmpty(username) || string.IsNullOrEmpty(password)) {
            return BadRequest("Invalid input");
        }

        RegisterModel rm = new RegisterModel();
        rm.Username = username;
        rm.Password = password;
        
        try {
            List<RegisterModel> existingUsers = LoadUsers();
            existingUsers.Add(rm);
            SaveUsers(existingUsers);

            return Ok("Benutzer erfolgreich registriert");
        }
        catch (Exception ex) {
            return StatusCode(500, $"Ein Fehler ist aufgetreten: {ex.Message}");
        }
    }
    
    [HttpPost("LoginUser")]
    public async Task<IActionResult> LoginUser([FromBody] LoginModel model) {
        
        if (model == null) {
            return BadRequest("Ungültige Anfragedaten");
        }
        // Implement user login logic here
        // Example: Validate credentials, generate and return a token, etc.
        // Return appropriate response, such as success or error message

        return Ok("User logged in successfully");
    }

    public class RegisterModel {
        public string Username { get; set; }
        public string Password { get; set; }
    }

    public class LoginModel {
        public string Username { get; set; }
        public string Password { get; set; }
    }
    
    private List<RegisterModel> LoadUsers() {
        if (!System.IO.File.Exists(jsonFilePath)) {
             System.IO.File.Create(jsonFilePath);
             System.IO.File.WriteAllText(jsonFilePath, "[]");
        }
        
            string jsonData = System.IO.File.ReadAllText(jsonFilePath);
            return JsonConvert.DeserializeObject<List<RegisterModel>>(jsonData);
    }

    private void SaveUsers(List<RegisterModel> users) {
        try {
            string jsonData = JsonConvert.SerializeObject(users);
            System.IO.File.WriteAllText(jsonFilePath, jsonData);
        } catch (Exception ex) {
            // Hier können Sie Fehlerbehandlung hinzufügen, z.B. Loggen oder eine benutzerfreundliche Fehlermeldung zurückgeben.
            Console.WriteLine($"Fehler beim Speichern der Benutzerdaten: {ex.Message}");
            throw; // Sie können den Fehler nach oben weitergeben oder anderweitig behandeln
        }
    }

    
}