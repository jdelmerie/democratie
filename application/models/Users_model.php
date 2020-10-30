<?
class Users_model extends CI_Model
{
    public function selectUser($pseudo)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('pseudo', $pseudo);
        $query = $this->db->get();
        return $query->result()[0];
    }

    public function selectById($id)
    {
        $this->db->select('id, pseudo');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result()[0];
    }
}
