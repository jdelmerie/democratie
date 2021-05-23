<?
class Users_model extends CI_Model
{
    public function getUserByPseudo($pseudo)
    {
        $this->db->where('pseudo', $pseudo);
        $query = $this->db->get('users');
        if (count($query->result()) > 0) {
            return $query->result()[0];
        }
    }

    public function getUser($session)
    {
        $this->db->where('session', $session);
        $query = $this->db->get('users');
        if (count($query->result()) > 0) {
            return $query->result()[0];
        }
    }

    public function getUserByEmail($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        if (count($query->result()) > 0) {
            return $query->result()[0];
        }
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->set($data);
        $this->db->update('users');
    }

    public function add($data)
    {
        $this->db->insert('users', $data);
    }
}
